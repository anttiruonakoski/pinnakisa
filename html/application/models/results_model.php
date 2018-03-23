<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results_model extends CI_Model {

	var $summary = Array();

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------
	// Osallistujat laskevassa pinnajärjestyksessä

	public function summary($contest_id)
	{
		// Participations
		$query = $this->db->get_where('kisa_participations', array('contest_id' => $contest_id));
		
		if (! isset($query))
		{
			exit("Tietokantavirhe. Ota yhteyttä webmasteriin.");
		}
		
		$resultArray = $query->result_array();
		
		// Sort by species_count
		usort($resultArray, array("Results_model", "sortBySpeciesCount"));
		
		// TODO: move elsewhere ?
		$this->summary = $resultArray; // Populates array for area ticks

		return $resultArray;
	}

	// ------------------------------------------------------------------------
	// Pinnapäivät yhdestä kisasta, JavaScript-dataa

	public function ticks_js_data($contest_id, $top)
	{
		// Get summary data
		$resultArray = $this->summary($contest_id);

		if (! isset($resultArray))
		{
			exit("Tietokantavirhe. Ota yhteyttä webmasteriin.");
		}
		
//		echo "<pre>"; print_r ($resultArray); echo "</pre>"; // debug
		
		// Create scipt data
		$allData = "";
		$i = 0;
		foreach ($resultArray as $nro => $part)
		{
			$partData = "";
			$partData .= "
			{
				name: '" . $part['name'] . "',			
				data: [ ";
			
			$json = json_decode($part['ticks_day_json'], TRUE);
//			echo "<pre>"; print_r ($json); echo "</pre>"; // debug
			
			$totalTicks = 0;
			foreach ($json as $day => $newTicks)
			{
				$totalTicks = $totalTicks + $newTicks;
				$partData .= "[Date.UTC(" . substr($day, 0, 4) . ", " . (substr($day, 5, 2) - 1) . ", " . substr($day, 8, 2) . "), " . $totalTicks . "], ";
			}
			
			$partData .= "]
			},";
			
			$allData .= $partData;
			
			$i++;
			if ($i >= $top)
			{
				break;
			}
		}
		
		$allData = htmlspecialchars($allData, ENT_COMPAT, 'UTF-8');

		// Script
		$allData = "
<script>
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'spline'
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e.%m.',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: 'Lajeja'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%A %e.%m.', this.x) +': '+ this.y + ' lajia';
                }
            },
			plotOptions: {
                spline: {
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 10,
							color: '#ff0000'
                        }
                    },
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 5,
                                lineWidth: 1
                            }
                        }
                    },
                }
            },

            series: [
			"
			.
			$allData
			.
			"
							]
					});
				});
			});
			</script>
			";
			
		return $allData;
	}

	// ------------------------------------------------------------------------
	// Vertailudata edellisiin kisoihin, JavaScript-dataa

	public function comparison_js_data($contest_id, $user_id)
	{
		// Get summary data
		$resultArray = $this->user_summary($contest_id, $user_id);

		if (! isset($resultArray))
		{
			exit("Tietokantavirhe. Ota yhteyttä webmasteriin.");
		}
		
		return $resultArray;
	}
	
	// ------------------------------------------------------------------------
	// Yhden osallistumisten lajilista yhdestä kisasta

	public function participation_summary($participation_id)
	{
		// Participation
		$this->db->from('kisa_participations');
		$this->db->where(array('id' => $participation_id));
		$query = $this->db->get();
		
		if (! isset($query))
		{
			exit("Tietokantavirhe. Ota yhteyttä webmasteriin.");
		}
		
		$resultArray = $query->result_array();
		
		return $resultArray;
		
	}
	
	// ------------------------------------------------------------------------
	// Yhden OSALLISTUJAN lajilista yhdestä kisasta

	public function user_summary($contest_id, $user_id)
	{
		// Participation
		$this->db->from('kisa_participations');
		$this->db->where(array('contest_id' => $contest_id, 'meta_created_user' => $user_id));
		$query = $this->db->get();
		
		if (! isset($query))
		{
			exit("Tietokantavirhe. Ota yhteyttä webmasteriin.");
		}
		
		$resultArray = $query->result_array();
		
		return $resultArray;
	}
	
	// ------------------------------------------------------------------------
	// 

	private static function sortBySpeciesCount($a, $b)
	{
		return $b["species_count"] - $a["species_count"];
	}
	
	// ------------------------------------------------------------------------
	// Alueiden pinnat

	public function areaTicks()
	{
		$locations = Array();
		
		foreach ($this->summary as $partNumber => $partArr)
		{
			$species = json_decode($partArr['species_json'], TRUE);
			foreach ($species as $abbr => $date)
			{
				$locations[$partArr['location']][$abbr] = 1;
			}
		}
		
		foreach ($locations as $loc => $ticks)
		{
			$speciesCounts[$loc] = count($ticks);
		}
		@arsort($speciesCounts);
		
		$result['locations'] = $locations;
		$result['speciesCounts'] = $speciesCounts;
		
//		echo "<pre>"; print_r ($result); echo "</pre>";
		return $result;
	}

	// ------------------------------------------------------------------------
/*
	public function listing($status = "all")
	{
		if ($status == "all")
		{
			// List all
			$query = $this->db->get('kisa_contests');
		}
		elseif ($status == "published")
		{
			$query = $this->db->get_where('kisa_contests', array('status' => 'published'));
		}
		elseif ($status == "archived")
		{
			$query = $this->db->get_where('kisa_contests', array('status' => 'archived'));
		}
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2. Ota yhteyttä webmasteriin.");
		}
		
		return $query->result_array();
	}
*/
	// ------------------------------------------------------------------------

}

/* End of file */
