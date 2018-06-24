<p id="clearer">&nbsp;</p>
</div> <!-- Content -->

<p id="footer">Pinnakisajärjestelmä: Mikko Heikkinen/<a href="https://www.biomi.org/">biomi.org</a>
 --
 Yhteydenotot: webmaster@lly.fi
 --
<?php
echo "<a href=\"" . base_url("pinna-tietosuojaseloste.pdf") . "\">tietosuojaseloste</a>";
// DEBUG: print_r($userData);

?>
 --
 <a href="https://www.lly.fi/">Lapin lintutieteellinen yhdistys ry</a>
 --
{elapsed_time} s

<?php
// Cannot be filtered; contains scripts
echo @$end;
?>
</body>
</html>
