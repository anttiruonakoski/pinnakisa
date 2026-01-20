import csv

#!/bin/python3

"""
Luodaan sovelluskelle sopiva species_list.tsv -tiedosto lajiluetteloista.
Lajilutttelon lähteenä https://www.birdlife.fi/lintutieto/suomessa-havaitut-lintulajit/luonnonvaraiset/
otettu taulukko tsv-muodossa.
"""

with open('suomessa_havaitut_luonnonvaraiset_linnut_lajiluettelo_2026.tsv', 'r', encoding='utf-8') as file:
    species_list = []
    reader = csv.reader(file, delimiter='\t')
    for row in reader:
        if len(row) > 0 and 'Heimo' not in row[0]:
            # Remove third column (index 2)
            filtered_row = row[:2] + row[3:] if len(row) > 2 else row
            # hylkää kauttalajit. discard species with "/" in their name
            if '/' in filtered_row[0]:
                continue
            if len(filtered_row) > 0 and str(filtered_row[0]).startswith('Lahko'):
                words = filtered_row[0].split()
                if len(words) >= 3:
                    filtered_row = [words[0], words[1], words[3]] + filtered_row[1:]
            else:
                # make first column uppercase
                filtered_row[0] = filtered_row[0].upper()
                # capitalize third and fourth columns (index 2 and 3)
                # yhdenmukaisuuden vuoksi vanhaan lajilistaan
                if len(filtered_row) > 2:
                    filtered_row[2] = filtered_row[2].capitalize()
                if len(filtered_row) > 3:
                    filtered_row[3] = filtered_row[3].capitalize()
            species_list.append(filtered_row)
            # add row number in the first column. starts with 10 and steps by 10
            row_number = (len(species_list)) * 10
            filtered_row.insert(0, row_number)
            # add empty column as the second column
            filtered_row.insert(1, '')
                
for i, row in enumerate(species_list):
 
    print(species_list[i])

with open('species_list_2026.tsv', 'w', encoding='utf-8', newline='') as outfile:
    writer = csv.writer(outfile, delimiter='\t')
    writer.writerows(species_list)