<?php

return [

    /*
     * Gedeelde labels. De werkwijze zelf staat in lang/nl/werkwijze.php,
     * zodat regio- en dienstenpagina's dezelfde stappen tonen.
     */
    'common' => [
        'eyebrow'         => 'Dienst',
        'breadcrumb_aria' => 'Kruimelpad',
        'breadcrumb_home' => 'Home',

        'cta_contact'   => 'Vraag een prijs',
        'cta_secondary' => 'Meer over :service',

        'when_heading'      => 'Wanneer is dit interessant?',
        'options_heading'   => 'Mogelijkheden en keuzes',
        'materials_heading' => 'Materialen en afwerking',

        'realisaties_heading' => 'Uit ons werk',
        'realisaties_note'    => 'Foto\'s uit eerdere opdrachten. Ze tonen ons werk in het algemeen; niet elke foto is een voorbeeld van precies deze uitvoering.',
        'realisatie_alt'      => 'Schrijnwerk van Van Kerkhoven — foto :n van :m',

        'faq_heading' => 'Veelgestelde vragen',

        'related_heading' => 'Gerelateerde diensten',
        'related_link'    => 'Naar :service',

        // Compact blok onderaan de bestaande hoofddienstenpagina's
        'subservices_heading' => 'Verder in detail',
        'subservices_intro'   => 'Aparte pagina\'s over onderdelen van deze dienst.',
        'subservices_link'    => 'Lees verder',
    ],

    'items' => [

        /* ── Binnendeuren ───────────────────────────────────────────────── */
        'binnendeuren' => [
            'name'             => 'Binnendeuren',
            'teaser'           => 'Deuren die de indeling en de sfeer van uw interieur mee bepalen — op maat van bestaande of nieuwe kaders.',
            'meta_title'       => 'Binnendeuren op maat in massief hout | Van Kerkhoven',
            'meta_description' => 'Binnendeuren op maat in massief hout, afgestemd op uw kaders, vloeren en interieur. Gemaakt in ons eigen werkhuis in Huldenberg en zelf geplaatst.',
            'h1'               => 'Binnendeuren op maat',
            'hero_intro'       => 'Een binnendeur bepaalt mee hoe een ruimte aanvoelt. Wij maken ze op maat van de kaders die er staan — of van de kaders die er nog moeten komen.',
            'service_type'     => 'Binnendeuren op maat',

            'what_heading' => 'Wat een binnendeur op maat inhoudt',
            'what'         => [
                'Een binnendeur op maat is meer dan een deurblad in een andere breedte. Het gaat over het blad, het kader, de aanslag, het beslag en de manier waarop het geheel aansluit op de vloer en de muur. Die onderdelen bepalen samen of een deur mooi sluit — en of hij dat over tien jaar nog doet.',
                'Bij ons wordt dat geheel in eigen werkhuis gemaakt. We vertrekken van de werkelijke opening: een gemetste dagkant is zelden overal even breed, een vloerpas verschilt van kamer tot kamer, en bij renovatie staat een bestaand kader vaak niet meer helemaal loodrecht. Wie daar met standaardmaten op afkomt, moet achteraf opvullen.',
                'We maken enkele en dubbele deuren, met of zonder glas, en met het kader dat u kiest: een klassieke omlijsting, een smalle lijst, of een aansluiting die in het pleisterwerk verdwijnt. Ook een deur die doorloopt tot tegen het plafond is technisch gewoon een opdracht — ze vraagt alleen meer voorbereiding.',
            ],
            'highlights' => [
                'Deurblad, kader, aanslag en beslag als één geheel',
                'Opgemeten in de bestaande opening',
                'Enkel of dubbel, met of zonder glas',
                'Gemaakt en geplaatst door onze eigen mensen',
            ],

            'when' => [
                ['title' => 'Bij renovatie', 'text' => 'De kaders blijven staan, maar de deuren zijn versleten of passen niet meer bij de nieuwe afwerking. We meten elk kader apart op en maken bladen die in de bestaande aanslag vallen.'],
                ['title' => 'Bij een herindeling', 'text' => 'Een muur verdwijnt, een kamer wordt gesplitst, een doorgang verschuift. Dan komen kader én deur nieuw, afgestemd op de nieuwe vloerafwerking.'],
                ['title' => 'Bij nieuwbouw', 'text' => 'De maten liggen op plan vast, de uitvoering nog niet. Hoogte, kaderprofiel en afwerking bespreken we voor de deuren in productie gaan.'],
                ['title' => 'Bij één vervangen deur', 'text' => 'Ook één deur kan. Dan zoeken we een profiel dat aansluit bij de deuren die blijven staan, zodat de nieuwe niet als vreemd element opvalt.'],
            ],

            'options' => [
                ['title' => 'Vlak of met paneel', 'text' => 'Een vlak deurblad past bij een strak interieur; een paneeldeur sluit aan bij oudere woningen en bij bestaande deuren die blijven hangen. Beide maken we in massief hout.'],
                ['title' => 'Hoogte en verhouding', 'text' => 'Een standaardhoogte is een gewoonte, geen verplichting. Een deur die tot tegen het plafond doorloopt, verandert de verhoudingen van een gang of leefruimte merkbaar.'],
                ['title' => 'Kader en omlijsting', 'text' => 'Een zichtbare omlijsting, een smalle lijst of een vlakke aansluiting — de keuze bepaalt hoe uitgesproken de deur in de muur staat.'],
                ['title' => 'Glas of vol', 'text' => 'Glas brengt licht in een gang zonder raam. In dat geval bespreken we vooraf de indeling van het glasvlak en de breedte van de omliggende delen.'],
                ['title' => 'Draairichting en beslag', 'text' => 'Waar de deur openslaat, bepaalt hoe een ruimte gebruikt wordt. Het beslag kiest u mee; wij zorgen dat aanslag en scharnieren op het gewicht van het blad berekend zijn.'],
                ['title' => 'Afwerking', 'text' => 'Geolied, gelakt of geschilderd. Wat het beste past, hangt af van de rest van het interieur en van hoeveel onderhoud u wil. We overlopen de opties op stalen.'],
            ],

            'werkwijze_intro' => 'Voor binnendeuren ziet het traject er zo uit:',

            'materials' => [
                'We werken in massief hout. Welke houtsoort past, hangt af van de uitstraling die u zoekt, van de afwerking die erop komt en van hoe zwaar het blad mag worden. Een deur die tot het plafond doorloopt, is nu eenmaal iets anders dan een smalle bergingsdeur.',
                'De afwerking bespreken we op stalen, niet op een foto. Kleur en glans zien er in het echt anders uit dan op een scherm — zeker bij hout, waar de nerf mee doorloopt in het eindresultaat.',
            ],

            'faq' => [
                ['q' => 'Kunnen jullie deuren maken voor bestaande kaders?', 'a' => 'Ja, dat is een groot deel van het werk. We meten het kader op en maken het blad daarop. Staat een kader niet meer haaks, dan houden we daar in de maatvoering rekening mee.'],
                ['q' => 'Maken jullie ook de kaders zelf?', 'a' => 'Ja. Bij nieuwbouw of een herindeling leveren we kader en deur als één geheel, zodat de aanslag en de afwerking op elkaar afgestemd zijn.'],
                ['q' => 'Kan ik één enkele deur laten maken?', 'a' => 'Dat kan. Kleine opdrachten pakken we op dezelfde manier aan als grote; alleen de doorlooptijd hangt af van wat er op dat moment in productie zit.'],
                ['q' => 'Hoe zit het met de speling ten opzichte van de vloer?', 'a' => 'Die bepalen we pas nadat de vloerafwerking vastligt. Anders klopt de speling onderaan niet, of komt de deur op een tapijt of dorpel vast te zitten.'],
                ['q' => 'Leveren jullie ook het beslag?', 'a' => 'We bespreken het beslag mee, zodat scharnieren en slot op het gewicht en het gebruik van de deur afgestemd zijn. Wat u zelf aanlevert, kunnen we uiteraard plaatsen.'],
                ['q' => 'Hoelang duurt het voor de deuren geplaatst zijn?', 'a' => 'Dat hangt af van het aantal deuren en van de planning in het werkhuis. Bij het voorstel geven we aan wat op dat moment realistisch is; we noemen liever een haalbare termijn dan een korte.'],
            ],

            'cta_heading' => 'Binnendeuren nodig voor uw woning?',
            'cta_text'    => 'Stuur ons de maten of foto\'s van de bestaande kaders. We laten weten wat mogelijk is en wat erbij komt kijken.',
        ],

        /* ── Buitendeuren ───────────────────────────────────────────────── */
        'buitendeuren' => [
            'name'             => 'Buitendeuren',
            'teaser'           => 'De voordeur is het eerste wat een bezoeker ziet — en het onderdeel dat het meest te verduren krijgt.',
            'meta_title'       => 'Buitendeuren op maat in massief hout | Van Kerkhoven',
            'meta_description' => 'Voordeuren en achterdeuren op maat in massief hout, afgestemd op uw gevel en het overige buitenschrijnwerk. Gemaakt en geplaatst door Van Kerkhoven.',
            'h1'               => 'Buitendeuren op maat',
            'hero_intro'       => 'Een buitendeur moet er goed uitzien én elke dag werken, jarenlang, in weer en wind. Wij maken ze op maat van uw gevel.',
            'service_type'     => 'Buitendeuren op maat',

            'what_heading' => 'Wat een buitendeur op maat inhoudt',
            'what'         => [
                'Een buitendeur staat op de scheiding tussen binnen en buiten en krijgt daar alles van mee: regen, zon, temperatuurverschillen en dagelijks gebruik. Dat stelt andere eisen dan een binnendeur. De opbouw van het blad, de aansluiting op de dorpel en de manier waarop water wordt weggeleid, wegen hier zwaarder dan de vormgeving.',
                'Tegelijk is het het onderdeel waar bezoekers als eerste naar kijken. Een voordeur die niet bij de gevel past, valt meteen op — en een voordeur die er wel bij past, valt juist niet op. Daarom vertrekken we van de gevel: de bestaande opening, de omliggende materialen en het schrijnwerk dat er verder in zit.',
                'We maken voordeuren, achterdeuren en bergingsdeuren, met of zonder zijlicht of bovenlicht. Bij renovatie meten we de bestaande opening op; bij nieuwbouw stemmen we de maatvoering af met de aannemer of de architect, liefst voor het metselwerk klaar is.',
            ],
            'highlights' => [
                'Voordeuren, achterdeuren en bergingsdeuren',
                'Afgestemd op de gevel en het overige buitenschrijnwerk',
                'Aansluiting op dorpel en waterafvoer mee bekeken',
                'Plaatsing door onze eigen dienst',
            ],

            'when' => [
                ['title' => 'Bij vervanging', 'text' => 'De bestaande deur sluit slecht, is vervormd of past niet meer bij een vernieuwde gevel. We meten de opening op en bouwen de nieuwe deur daarrond.'],
                ['title' => 'Bij een gevelrenovatie', 'text' => 'Wanneer ramen en deuren samen vervangen worden, kunnen profiel, houtsoort en afwerking op elkaar afgestemd worden. Dat geeft een rustiger gevelbeeld dan stuk per stuk vervangen.'],
                ['title' => 'Bij nieuwbouw', 'text' => 'De opening ligt op plan vast, maar de uitvoering nog niet. Hoe vroeger we meekijken, hoe eenvoudiger de aansluitingen later te maken zijn.'],
                ['title' => 'Bij een bijgebouw of berging', 'text' => 'Ook een deur naar een garage, tuinhuis of berging kan in dezelfde houtsoort en afwerking als de rest, zodat het geheel één ding blijft.'],
            ],

            'options' => [
                ['title' => 'Vol of met glas', 'text' => 'Een vol blad geeft geslotenheid, glas brengt licht in de inkomhal. Vaak wordt het een combinatie: een vol onderste deel met een glasvlak of een bovenlicht erboven.'],
                ['title' => 'Klassiek of strak', 'text' => 'Een paneeldeur met profilering hoort bij oudere gevels; een vlak blad met een verticale greep bij hedendaagse architectuur. We maken de profielen zelf, dus u bent niet aan een catalogus gebonden.'],
                ['title' => 'Zijlicht en bovenlicht', 'text' => 'Is de opening breder of hoger dan een deurblad, dan wordt het geheel opgedeeld. Hoe die verdeling loopt, bepaalt het gevelbeeld sterk.'],
                ['title' => 'Beslag en sluiting', 'text' => 'Grepen, scharnieren en sluitwerk kiest u mee. We stemmen ze af op het gewicht van het blad en op hoe intensief de deur gebruikt wordt.'],
                ['title' => 'Afwerking', 'text' => 'Buitenschrijnwerk vraagt een afwerking die tegen zon en regen kan. Wat in uw situatie zinvol is, hangt af van de oriëntatie van de gevel en van hoeveel onderhoud u wil doen — dat bespreken we eerlijk.'],
            ],

            'werkwijze_intro' => 'Voor een buitendeur verloopt een opdracht zo:',

            'materials' => [
                'We werken in massief hout. De houtsoort kiezen we in overleg, op basis van de ligging van de deur, de mate waarin ze beschut staat en de afwerking die erop komt. Een deur op het zuiden zonder luifel vraagt nu eenmaal andere afspraken dan een deur in een beschutte inkom.',
                'Over levensduur en onderhoudsintervallen doen we geen beloftes op papier. Wat we wel doen, is vooraf zeggen wat een bepaalde keuze in de praktijk betekent, zodat u achteraf niet voor verrassingen staat.',
            ],

            'faq' => [
                ['q' => 'Kunnen jullie een bestaande voordeur vervangen zonder de gevel aan te passen?', 'a' => 'Meestal wel. We meten de bestaande opening en de aanslagpunten op en bouwen de nieuwe deur daarrond. Pas wanneer het metselwerk of de dorpel niet meer in orde is, komt er meer bij kijken; dat zeggen we bij de opmeting.'],
                ['q' => 'Kunnen deur en ramen in dezelfde stijl?', 'a' => 'Ja, en dat is meestal ook het advies. Wanneer we het volledige buitenschrijnwerk uitvoeren, houden we profiel, houtsoort en afwerking gelijk.'],
                ['q' => 'Maken jullie ook deuren met een zijlicht of bovenlicht?', 'a' => 'Ja. Bij bredere of hogere openingen delen we het geheel op; die verdeling bespreken we vooraf, omdat ze het gevelbeeld sterk bepaalt.'],
                ['q' => 'Wat met de veiligheid van de deur?', 'a' => 'Sluitwerk en beslag bespreken we mee. Welke oplossing zinvol is, hangt af van de situatie; we noemen geen beveiligingsklassen die we niet kunnen hardmaken.'],
                ['q' => 'Hoeveel onderhoud vraagt een houten buitendeur?', 'a' => 'Dat hangt af van de afwerking en van hoe blootgesteld de deur staat. Bij de bespreking zeggen we wat u in uw situatie realistisch mag verwachten.'],
                ['q' => 'Plaatsen jullie de deur ook zelf?', 'a' => 'Ja, met onze eigen plaatsingsdienst. Zo blijft één partij verantwoordelijk voor het blad, het kader en de aansluitingen.'],
            ],

            'cta_heading' => 'Een nieuwe buitendeur voor uw woning?',
            'cta_text'    => 'Stuur ons een foto van de bestaande gevel en de opening. We laten weten wat mogelijk is.',
        ],

        /* ── Houten ramen ───────────────────────────────────────────────── */
        'houten-ramen' => [
            'name'             => 'Houten ramen',
            'teaser'           => 'Ramen in massief hout, opgemeten in de bestaande opening en afgestemd op de architectuur van de woning.',
            'meta_title'       => 'Houten ramen op maat in massief hout | Van Kerkhoven',
            'meta_description' => 'Houten ramen op maat voor renovatie en nieuwbouw. Profiel, indeling en afwerking afgestemd op uw gevel, gemaakt in ons werkhuis in Huldenberg.',
            'h1'               => 'Houten ramen op maat',
            'hero_intro'       => 'Hout geeft een gevel iets wat andere materialen moeilijk halen: een profiel met diepte en een nerf die meeleeft met het licht.',
            'service_type'     => 'Houten ramen op maat',

            'what_heading' => 'Wat houten ramen op maat inhouden',
            'what'         => [
                'Een raam op maat begint bij de opening, niet bij een catalogus. We meten elke opening apart op — in renovatie op meerdere hoogtes, want een gemetste dagkant loopt zelden helemaal recht. Op basis van die maten tekenen we de indeling, het profiel en de aansluitingen.',
                'Daarna wordt het raam in ons eigen werkhuis gemaakt: het hout wordt geschaafd, de profielen gefreesd, de verbindingen gemaakt en het geheel afgewerkt. Omdat een profiel bij ons een instelling is en geen artikelnummer, kan het raam de vorm krijgen die de gevel vraagt in plaats van omgekeerd.',
                'We werken zowel voor renovaties — waar het bestaande gevelbeeld het uitgangspunt is — als voor nieuwbouw, waar de maatvoering nog met de aannemer of de architect afgestemd kan worden.',
            ],
            'highlights' => [
                'Elke opening apart opgemeten',
                'Profiel en indeling op maat, niet uit catalogus',
                'Renovatie en nieuwbouw',
                'Eigen werkhuis en eigen plaatsingsdienst',
            ],

            'when' => [
                ['title' => 'Bij renovatie van een oudere woning', 'text' => 'De bestaande ramen zijn versleten, maar het gevelbeeld moet blijven kloppen. We nemen de bestaande indeling en profieldiepte als vertrekpunt en werken die uit in een hedendaagse uitvoering.'],
                ['title' => 'Wanneer het gevelbeeld meetelt', 'text' => 'In een straat waar de gevels samen het beeld bepalen, weegt de verdeling van het raam zwaarder dan het materiaal. Hout laat fijne indelingen toe zonder dat het profiel zwaar wordt.'],
                ['title' => 'Bij nieuwbouw met een warme uitstraling', 'text' => 'Ook in nieuwbouw wordt vaak voor hout gekozen — juist omdat het aan de binnenzijde iets anders geeft dan een vlak, koel profiel.'],
                ['title' => 'Bij gefaseerd vervangen', 'text' => 'Eerst de straatgevel, later de tuingevel. Omdat wij het eerdere werk zelf gemaakt hebben, weten we welk profiel en welke afwerking toen gekozen zijn.'],
            ],

            'options' => [
                ['title' => 'Indeling en verdeling', 'text' => 'Vaste delen, draaiende delen, kiepramen, een verdeling met roeden. Uw keuze bepaalt zowel het uitzicht als het gebruiksgemak; we tekenen het uit voor er iets gemaakt wordt.'],
                ['title' => 'Profieldiepte', 'text' => 'Een fijn profiel geeft een lichter gevelbeeld, een zwaarder profiel sluit beter aan bij oudere woningen. Bij ons is dat een keuze, geen beperking van het systeem.'],
                ['title' => 'Beglazing', 'text' => 'Welke beglazing in uw situatie past, bespreken we op basis van wat er staat en wat u wil bereiken. We plakken geen prestatiecijfers op een project dat we nog niet gezien hebben.'],
                ['title' => 'Afwerking', 'text' => 'Geschilderd, gelakt of transparant afgewerkt, waarbij de nerf zichtbaar blijft. De keuze hangt samen met de gewenste uitstraling en met het onderhoud.'],
                ['title' => 'Aansluitingen', 'text' => 'Dorpels, binnenafwerking en isolatie horen bij het raam. Bij de opmeting kijken we naar de volledige aansluiting, niet alleen naar het kader.'],
            ],

            'werkwijze_intro' => 'Voor houten ramen verloopt het zo:',

            'materials' => [
                'We werken in massief hout. Welke houtsoort past, hangt af van de oriëntatie van de gevel, van de gewenste afwerking en van hoeveel onderhoud u wil doen. Er is geen houtsoort die in elke situatie de beste keuze is, en we doen ook niet alsof.',
                'Stalen en profielstukken kunt u na afspraak in het werkhuis bekijken. In het echt kiest een houtsoort en een kleur een stuk makkelijker dan op een scherm.',
            ],

            'faq' => [
                ['q' => 'Werken jullie met standaardmaten?', 'a' => 'Nee. Elke opening wordt apart opgemeten. Bij renovatie zijn er nauwelijks twee gelijk, en zelfs bij nieuwbouw wijkt de uitvoering vaak af van het plan.'],
                ['q' => 'Kan een nieuw raam aansluiten bij een oudere gevel?', 'a' => 'Dat is vaak precies de opdracht. We vertrekken van de bestaande indeling en profieldiepte en voeren die uit met hedendaagse beglazing en beslag.'],
                ['q' => 'Vervangen jullie ook één enkel raam?', 'a' => 'Ja. We houden dan wel rekening met de ramen die blijven staan, zodat het nieuwe stuk niet als vreemd element in de gevel valt.'],
                ['q' => 'Doen jullie ook de binnenafwerking?', 'a' => 'Bij de opmeting bekijken we de volledige aansluiting: dorpel, isolatie en binnenafwerking. Wat we precies opnemen, spreken we vooraf af, zodat er achteraf geen gaten in de planning vallen.'],
                ['q' => 'Wat is het verschil met aluminium ramen?', 'a' => 'Kort gezegd: hout geeft meer vrijheid in het profiel en een warmere uitstraling, aluminium een strakker en smaller beeld. Welk materiaal past, hangt af van de architectuur en van het onderhoud dat u wil.'],
                ['q' => 'Kan ik een staal van de houtsoort en de afwerking zien?', 'a' => 'Ja, na afspraak in het werkhuis in Huldenberg. Neem gerust een kleurstaal of een foto van uw gevel mee — naast elkaar ziet u meteen wat past.'],
            ],

            'cta_heading' => 'Houten ramen voor uw woning?',
            'cta_text'    => 'Stuur ons foto\'s van de bestaande gevel en een korte omschrijving. We bekijken wat mogelijk is.',
        ],

        /* ── Aluminium ramen ────────────────────────────────────────────── */
        'aluminium-ramen' => [
            'name'             => 'Aluminium ramen',
            'teaser'           => 'Een strak, smal profiel voor wie een hedendaags gevelbeeld en grote glasvlakken zoekt.',
            'meta_title'       => 'Aluminium ramen op maat voor uw woning | Van Kerkhoven',
            'meta_description' => 'Aluminium ramen op maat voor hedendaagse architectuur en grote glaspartijen. Opgemeten, besproken en geplaatst door Van Kerkhoven uit Huldenberg.',
            'h1'               => 'Aluminium ramen op maat',
            'hero_intro'       => 'Waar een gevel om een smal profiel en een groot glasvlak vraagt, is aluminium vaak de logische keuze.',
            'service_type'     => 'Aluminium ramen op maat',

            'what_heading' => 'Wat aluminium ramen op maat inhouden',
            'what'         => [
                'Van Kerkhoven is in de eerste plaats een schrijnwerkerij: het meeste van wat we maken, is massief hout uit ons eigen werkhuis. Toch vraagt niet elk project om hout. Wanneer een gevel om een uitgesproken smal profiel of een heel groot glasvlak vraagt, is aluminium doorgaans de betere oplossing.',
                'De aanpak blijft dezelfde. We beginnen bij de opening en bij wat u wil bereiken, niet bij een productlijst. We meten ter plaatse op, bespreken de indeling en de openingswijze, en zorgen dat de aansluiting op de gevel en op de binnenafwerking klopt.',
                'Vaak gaat het om een combinatie: hout waar het beeld en de warmte tellen, aluminium waar het profiel zo smal mogelijk moet blijven. Dat is geen probleem, zolang de keuze bewust gemaakt wordt en niet per gevel anders uitvalt.',
            ],
            'highlights' => [
                'Voor hedendaagse architectuur en grote glasvlakken',
                'Opmeting in de bestaande situatie',
                'Ook in combinatie met houten schrijnwerk',
                'Eén aanspreekpunt van bespreking tot plaatsing',
            ],

            'when' => [
                ['title' => 'Bij hedendaagse nieuwbouw', 'text' => 'Wanneer het ontwerp uitgaat van een minimaal zichtbaar profiel en grote, doorlopende glasvlakken.'],
                ['title' => 'Bij een uitbreiding of aanbouw', 'text' => 'Een nieuwe leefruimte aan een bestaande woning krijgt vaak bewust een ander karakter dan het bestaande deel. Aluminium onderstreept dat verschil.'],
                ['title' => 'Wanneer onderhoud zwaar meetelt', 'text' => 'Wie het onderhoud aan buitenschrijnwerk zo beperkt mogelijk wil houden, komt vaak bij aluminium uit. Wat dat concreet betekent, bespreken we op basis van uw situatie.'],
                ['title' => 'Bij een combinatie van materialen', 'text' => 'Hout aan de straatzijde, aluminium aan de tuinzijde — of omgekeerd. We stemmen kleuren en verdelingen af zodat het geheel samenhangt.'],
            ],

            'options' => [
                ['title' => 'Indeling en openingswijze', 'text' => 'Vaste delen, draaiende of kiepende delen, of een schuivende oplossing. De keuze bepaalt zowel het gebruik als hoeveel profiel er zichtbaar blijft.'],
                ['title' => 'Kleur en afwerking', 'text' => 'De afwerkingskleur bespreken we samen; ze bepaalt sterk of het schrijnwerk uitgesproken of net onopvallend in de gevel staat.'],
                ['title' => 'Verhouding tot het glasvlak', 'text' => 'Hoe groter het glasvlak, hoe zwaarder de constructie en het beslag moeten zijn. Wat in uw situatie haalbaar is, bekijken we bij de opmeting.'],
                ['title' => 'Combinatie met hout', 'text' => 'Aluminium en hout naast elkaar kan, mits de verdelingen en de kleuren op elkaar afgestemd zijn. Dat is precies het soort afweging waar we vooraf tijd in steken.'],
                ['title' => 'Aansluiting op de gevel', 'text' => 'Dorpels, isolatie en binnenafwerking horen bij het raam. We bekijken de volledige aansluiting, niet enkel het profiel.'],
            ],

            'werkwijze_intro' => 'Ook voor aluminium ramen volgen we hetzelfde traject:',

            'materials' => [
                'Over technische prestaties — isolatiewaarden, geluidsdemping, inbraakwerendheid — doen we op deze pagina bewust geen uitspraken. Die hangen af van de concrete uitvoering, en het heeft geen zin daar cijfers op te plakken voor uw project bekeken is.',
                'Wat we wel doen: samen bepalen wat de gevel en het gebruik vragen, en op basis daarvan een voorstel maken. Blijkt hout in uw situatie de betere keuze, dan zeggen we dat ook.',
            ],

            'faq' => [
                ['q' => 'Maken jullie aluminium ramen zelf in het werkhuis?', 'a' => 'Ons eigen werkhuis is ingericht op massief hout. Hoe een opdracht in aluminium bij ons concreet verloopt, bespreken we vooraf, zodat op voorhand duidelijk is wat wij doen.'],
                ['q' => 'Kan ik hout en aluminium combineren in dezelfde woning?', 'a' => 'Ja, en dat gebeurt vaker dan u denkt: hout waar het beeld telt, aluminium waar het profiel zo smal mogelijk moet blijven. We stemmen kleuren en verdelingen op elkaar af.'],
                ['q' => 'Welke isolatiewaarde halen aluminium ramen?', 'a' => 'Dat hangt volledig af van de uitvoering en de beglazing. We noemen daar op voorhand geen getal voor; bij het voorstel krijgt u de gegevens die bij de gekozen uitvoering horen.'],
                ['q' => 'Is aluminium onderhoudsvrij?', 'a' => 'Onderhoudsarm is een eerlijker woord dan onderhoudsvrij. Wat het in de praktijk vraagt, hangt af van de ligging en de afwerking; dat bespreken we concreet.'],
                ['q' => 'Kunnen bestaande ramen vervangen worden door aluminium?', 'a' => 'Dat kan, maar het is niet altijd de beste keuze. Bij een oudere gevel geeft een smal profiel soms een beeld dat niet bij de woning past. We zeggen het wanneer we dat vinden.'],
                ['q' => 'Hoe vraag ik een voorstel aan?', 'a' => 'Via het contactformulier, liefst met foto\'s van de situatie en een korte omschrijving van wat u voor ogen hebt. We laten weten wat we nodig hebben om verder te gaan.'],
                ['q' => 'Kunnen jullie ook grote schuivende glaspartijen leveren?', 'a' => 'Dat hangt af van de afmetingen en van wat de constructie toelaat. Bij grote schuivende delen bepalen het gewicht en de geleiding wat haalbaar is; dat bekijken we bij de opmeting ter plaatse.'],
            ],

            'cta_heading' => 'Een project met aluminium schrijnwerk?',
            'cta_text'    => 'Vertel ons wat u voor ogen hebt en waar het over gaat. We bekijken samen welk materiaal het beste past.',
        ],

        /* ── Garagepoorten ──────────────────────────────────────────────── */
        'garagepoorten' => [
            'name'             => 'Garagepoorten',
            'teaser'           => 'Een poort die elke dag gebruikt wordt en tegelijk een groot deel van de gevel inneemt.',
            'meta_title'       => 'Garagepoorten op maat in massief hout | Van Kerkhoven',
            'meta_description' => 'Houten garagepoorten op maat, ingepast in de bestaande gevelopening. Van opmeting tot plaatsing verzorgd door Van Kerkhoven uit Huldenberg.',
            'h1'               => 'Garagepoorten op maat',
            'hero_intro'       => 'Een garagepoort is meteen een van de grootste vlakken in de gevel. Ze moet dus werken én kloppen met de rest.',
            'service_type'     => 'Garagepoorten op maat',

            'what_heading' => 'Wat een garagepoort op maat inhoudt',
            'what'         => [
                'Een garagepoort verschilt op twee punten van ander buitenschrijnwerk: de afmetingen en het gebruik. Ze is groot, ze weegt, en ze gaat dagelijks open en dicht. Dat maakt de constructie en het beslag minstens even belangrijk als het uitzicht.',
                'Daarom vertrekken we bij een poort van de opening en van de aanslagpunten. Een poort in een open oprit staat anders in de wind dan een poort tussen twee muren, en een gemetste opening in een oudere woning is zelden overal even breed. Die maten nemen we zelf op.',
                'Daarnaast bepaalt de poort een groot stuk van het gevelbeeld. Vaak loont het om de poort, de naastliggende deur en het overige buitenschrijnwerk in dezelfde houtsoort en afwerking uit te voeren, zodat de gevel één geheel blijft.',
            ],
            'highlights' => [
                'Opgemeten in de bestaande opening',
                'Constructie en beslag afgestemd op het gewicht',
                'Afwerking afstembaar op de rest van de gevel',
                'Plaatsing en afstelling door onze eigen dienst',
            ],

            'when' => [
                ['title' => 'Bij een versleten poort', 'text' => 'De poort hangt scheef, sluit niet meer of het hout is op. We meten de opening opnieuw op in plaats van te vertrouwen op de maten van de oude poort.'],
                ['title' => 'Bij een gevelrenovatie', 'text' => 'Wanneer de gevel toch aangepakt wordt, is dit het moment om poort, deur en ramen op elkaar af te stemmen.'],
                ['title' => 'Bij een verbouwde hoeve of bijgebouw', 'text' => 'Grote openingen in oudere gebouwen vragen een constructie die op de overspanning berekend is. Daar maakt maatwerk het verschil.'],
                ['title' => 'Bij nieuwbouw', 'text' => 'De opening ligt op plan vast; hoe vroeger we meekijken, hoe eenvoudiger de aansluiting op het metselwerk en de dorpel wordt.'],
            ],

            'options' => [
                ['title' => 'Openingswijze', 'text' => 'Draaiend in twee delen of een andere oplossing die bij de opening past. Wat in uw situatie kan, hangt af van de opening, de oprit en de ruimte binnen; dat bekijken we ter plaatse.'],
                ['title' => 'Indeling van het vlak', 'text' => 'Verticale delen, een horizontale belijning of een vlak zonder zichtbare verdeling. Op een groot vlak zie je die keuze meteen.'],
                ['title' => 'Beslag', 'text' => 'Scharnieren, sluitwerk en geleiding kiezen we op basis van het gewicht en het dagelijkse gebruik. Op een poort is dat geen detail.'],
                ['title' => 'Aansluiting op de gevel', 'text' => 'Een poort staat zelden alleen: er zit een deur naast, een dorpel onder en metselwerk rond. Die aansluitingen bepalen mee hoe lang het geheel mooi blijft.'],
                ['title' => 'Afwerking', 'text' => 'Geschilderd, gebeitst of transparant afgewerkt. Wat verstandig is, hangt samen met de ligging en de blootstelling van de poort; dat bespreken we voor de keuze vastligt.'],
            ],

            'werkwijze_intro' => 'Voor een garagepoort ziet het traject er zo uit:',

            'materials' => [
                'We werken in massief hout. Op een poort telt de opbouw extra zwaar door: een groot vlak dat dagelijks beweegt, moet stabiel blijven. Dat bepaalt mee welke houtsoort en welke opbouw zinvol zijn.',
                'Over een aangedreven bediening doen we op deze pagina geen beloftes. Wil u dat, breng het dan ter sprake bij het eerste contact, zodat meteen duidelijk is wat wij daarin opnemen.',
            ],

            'faq' => [
                ['q' => 'Meten jullie de bestaande opening op?', 'a' => 'Altijd. We nemen de opening, de aanslagpunten en de vloerpas zelf op; de maten van de oude poort kloppen zelden nog.'],
                ['q' => 'Kan een poort in dezelfde afwerking als de rest van het schrijnwerk?', 'a' => 'Ja, en meestal is dat ook het advies. Poort, deur en ramen in dezelfde houtsoort en afwerking geven een veel rustiger gevel.'],
                ['q' => 'Kunnen jullie een poort maken voor een grote opening in een hoeve of bijgebouw?', 'a' => 'Dat kan. Bij grote overspanningen bepaalt de constructie het resultaat; we bekijken ter plaatse wat haalbaar is.'],
                ['q' => 'Leveren jullie ook geautomatiseerde poorten?', 'a' => 'Breng dat ter sprake bij het eerste contact. Dan zeggen we meteen wat we in uw geval kunnen opnemen, in plaats van het achteraf te moeten bijstellen.'],
                ['q' => 'Hoeveel onderhoud vraagt een houten poort?', 'a' => 'Dat hangt af van de ligging en van de afwerking. Een poort op het zuiden zonder beschutting vraagt meer opvolging dan een poort in de schaduw. We zeggen op voorhand wat u mag verwachten.'],
                ['q' => 'Plaatsen jullie de poort zelf?', 'a' => 'Ja, met onze eigen plaatsingsdienst — inclusief het afstellen na de plaatsing.'],
                ['q' => 'Kan er een aparte loopdeur naast de poort komen?', 'a' => 'Ja, dat is een veelgevraagde combinatie: een loopdeur naast de poort in dezelfde houtsoort en afwerking, zodat u niet telkens de volledige poort hoeft te openen.'],
            ],

            'cta_heading' => 'Een nieuwe garagepoort?',
            'cta_text'    => 'Stuur ons een foto van de opening en de gevel, met de maten als u ze hebt. We laten weten wat mogelijk is.',
        ],

        /* ── Maatkasten ─────────────────────────────────────────────────── */
        'maatkasten' => [
            'name'             => 'Maatkasten',
            'teaser'           => 'Ingemaakte kasten die de ruimte volgen die er is — ook onder een schuin dak of in een verloren hoek.',
            'meta_title'       => 'Maatkasten en ingemaakte kasten op maat | Van Kerkhoven',
            'meta_description' => 'Ingemaakte kasten op maat voor schuine wanden, nissen en verloren hoeken. Ontworpen, gemaakt en geplaatst door Van Kerkhoven uit Huldenberg.',
            'h1'               => 'Maatkasten op maat',
            'hero_intro'       => 'Een kast op maat vult de ruimte die er werkelijk is — inclusief de schuine wand, de nis en de hoek waar niets standaards in past.',
            'service_type'     => 'Maatkasten en interieurmaatwerk',

            'what_heading' => 'Wat maatwerk in kasten oplevert',
            'what'         => [
                'Het verschil tussen een kast op maat en een kast uit de winkel zit in de centimeters die u niet ziet. Een standaardkast laat aan de zijkant een spleet, bovenaan een stoflaag en achteraan een verloren strook. Bij een ingemaakte kast bestaat die ruimte niet: de kast ís de ruimte.',
                'Dat wordt pas echt interessant waar de ruimte niet rechthoekig is. Onder een schuin dak, in een nis naast een schoorsteen, in een gang die versmalt, of rond een bestaande deur of raam. Precies daar loopt standaardmeubilair vast en begint schrijnwerk.',
                'We ontwerpen de kast samen met u: wat erin moet, hoe u hem gebruikt en hoe hij zich verhoudt tot de rest van de ruimte. Daarna wordt hij in ons eigen werkhuis gemaakt en bij u geplaatst en afgeregeld.',
            ],
            'highlights' => [
                'Ontworpen rond de werkelijke ruimte',
                'Schuine wanden, nissen en hoeken',
                'Indeling afgestemd op het gebruik',
                'Gemaakt in eigen werkhuis, geplaatst door onze ploeg',
            ],

            'when' => [
                ['title' => 'Onder een schuin dak', 'text' => 'Een zolder of slaapkamer met dakschuinte is de klassieke situatie waar standaardkasten weinig opleveren en maatwerk meteen ruimte wint.'],
                ['title' => 'In een nis of verloren hoek', 'text' => 'Ruimtes naast een schoorsteen, onder een trap of in een inspringende muur worden bruikbaar zodra de kast de vorm van de ruimte volgt.'],
                ['title' => 'Bij een renovatie', 'text' => 'Wanneer de indeling toch verandert, is het eenvoudiger om de kasten mee te ontwerpen dan er achteraf iets in te passen.'],
                ['title' => 'Wanneer het geheel moet kloppen', 'text' => 'Kasten in dezelfde afwerking als de binnendeuren of de trap laten een interieur als één ding lezen, in plaats van als losse aankopen.'],
            ],

            'options' => [
                ['title' => 'Indeling', 'text' => 'Legplanken, hanggedeeltes, lades of een combinatie. Wat u erin bewaart, bepaalt de indeling — niet omgekeerd.'],
                ['title' => 'Deuren of open', 'text' => 'Volledig gesloten, deels open, of met open vakken op ooghoogte. Open delen maken een kast lichter, gesloten delen houden een ruimte rustig.'],
                ['title' => 'Grepen of greeploos', 'text' => 'Een zichtbare greep of een greeploze uitvoering verandert het karakter van de kast aanzienlijk, zeker over een groot vlak.'],
                ['title' => 'Aansluiting op de ruimte', 'text' => 'Doorlopen tot tegen het plafond of er net onder stoppen, met of zonder plint — die keuzes bepalen of de kast als meubel of als deel van de muur leest.'],
                ['title' => 'Afwerking', 'text' => 'Geschilderd, gelakt of met zichtbare houtnerf. We bespreken het op stalen, samen met de rest van het interieur.'],
            ],

            'werkwijze_intro' => 'Voor een maatkast verloopt het zo:',

            'materials' => [
                'Welke materialen en afwerking het meest geschikt zijn, hangt af van de plek en het gebruik: een kledingkast in een slaapkamer stelt andere eisen dan een bergkast in een gang of een inbouw in een vochtigere ruimte. Dat overlopen we bij de bespreking.',
                'Wat we niet doen, is een materiaalkeuze doordrukken omdat ze bij ons het makkelijkst te maken is. Is iets voor uw situatie geen goed idee, dan zeggen we dat.',
            ],

            'faq' => [
                ['q' => 'Kunnen jullie een kast maken onder een schuin dak?', 'a' => 'Ja, dat is een van de situaties waar maatwerk het meest oplevert. We meten de schuinte, de hoogte en de dakstructuur op en tekenen de kast daarrond.'],
                ['q' => 'Ontwerpen jullie de kast, of moet ik met een plan komen?', 'a' => 'Beide kan. Vaak vertrekken we van een schets of van foto\'s en werken we samen uit wat erin moet en hoe u de kast gebruikt.'],
                ['q' => 'Kunnen kasten en binnendeuren in dezelfde afwerking?', 'a' => 'Ja. Wanneer we allebei maken, houden we de houtsoort en de afwerking gelijk zodat het interieur samenhangt.'],
                ['q' => 'Wordt de kast bij mij geplaatst of geleverd?', 'a' => 'We plaatsen zelf en stellen ter plaatse af. In een ruimte die niet haaks is, is juist dat afstellen het werk dat het resultaat bepaalt.'],
                ['q' => 'Doen jullie ook ander interieurmaatwerk dan kasten?', 'a' => 'Ja. Maatwerk in hout — van meubilair tot wandbekleding — hoort bij ons werk. Beschrijf gerust wat u in gedachten hebt.'],
                ['q' => 'Wat kost een maatkast?', 'a' => 'Dat hangt te sterk af van de afmetingen, de indeling en de afwerking om er een richtprijs op te plakken. Na een bespreking en een opmeting krijgt u een offerte die op uw situatie slaat.'],
                ['q' => 'Hoelang duurt het van bespreking tot plaatsing?', 'a' => 'Dat hangt af van de omvang en van wat er in het werkhuis loopt. Bij het voorstel geven we aan wat op dat moment realistisch is, zodat u de rest van uw planning erop kunt afstemmen.'],
            ],

            'cta_heading' => 'Een kast die precies past?',
            'cta_text'    => 'Stuur ons foto\'s van de ruimte en een omschrijving van wat erin moet. We denken mee over de indeling.',
        ],

        /* ── Gevelbekleding ─────────────────────────────────────────────── */
        'gevelbekleding' => [
            'name'             => 'Gevelbekleding',
            'teaser'           => 'Houten gevelbekleding verandert het karakter van een woning en werkt de gevel eronder af.',
            'meta_title'       => 'Houten gevelbekleding voor uw woning | Van Kerkhoven',
            'meta_description' => 'Houten gevelbekleding voor renovatie en nieuwbouw, afgestemd op ramen, deuren en de rest van de gevel. Uitgevoerd door Van Kerkhoven uit Huldenberg.',
            'h1'               => 'Gevelbekleding in hout',
            'hero_intro'       => 'Een houten gevel verandert een woning ingrijpender dan bijna elke andere ingreep — en raakt meteen aan alles wat er in die gevel zit.',
            'service_type'     => 'Houten gevelbekleding',

            'what_heading' => 'Wat houten gevelbekleding inhoudt',
            'what'         => [
                'Gevelbekleding is een afwerkingslaag in hout die over de bestaande of nieuwe gevel komt. Ze bepaalt in één klap de uitstraling van de woning: dezelfde volumes lezen totaal anders in baksteen dan in verticaal geplaatst hout.',
                'Tegelijk is het het onderdeel dat het meest met de rest van de gevel te maken heeft. Rond elk raam, elke deur en elke poort moet de bekleding netjes aansluiten, en die aansluitingen bepalen uiteindelijk of het geheel afgewerkt oogt. Daarom is het meestal verstandig om gevelbekleding en buitenschrijnwerk samen te bekijken.',
                'We voeren gevelbekleding uit bij renovatie — waar ze vaak samengaat met het vervangen van ramen en deuren — en bij nieuwbouw, waar de opbouw al in het ontwerp zit.',
            ],
            'highlights' => [
                'Aansluitingen op ramen, deuren en poorten mee bekeken',
                'Renovatie en nieuwbouw',
                'Verticaal, horizontaal of met een eigen belijning',
                'Dezelfde ploeg als voor uw overige buitenschrijnwerk',
            ],

            'when' => [
                ['title' => 'Bij een gevelrenovatie', 'text' => 'Wordt de gevel toch aangepakt, dan is dit het moment: bekleding en nieuw buitenschrijnwerk in één beweging geeft de nette aansluitingen die achteraf moeilijk te maken zijn.'],
                ['title' => 'Bij een uitbreiding', 'text' => 'Een aanbouw in hout tegen een bestaande bakstenen woning maakt het onderscheid tussen oud en nieuw zichtbaar, in plaats van het te verstoppen.'],
                ['title' => 'Bij een bijgebouw of carport', 'text' => 'Een berging, carport of tuinhuis in dezelfde bekleding als de woning laat het geheel als één ontwerp lezen.'],
                ['title' => 'Wanneer de woning te vlak oogt', 'text' => 'Een gevel met weinig reliëf krijgt met een houten belijning meteen diepte en richting.'],
                ['title' => 'Bij een gevel die aan onderhoud toe is', 'text' => 'Soms is bekleding een manier om een gevel die er niet meer uitziet opnieuw af te werken. Of dat in uw geval de juiste oplossing is, hangt af van wat eronder zit; dat bekijken we eerst.'],
            ],

            'options' => [
                ['title' => 'Richting van de belijning', 'text' => 'Verticaal maakt een gevel optisch hoger, horizontaal breder. Op een grote woning is dat een van de meest bepalende keuzes.'],
                ['title' => 'Breedte en ritme van de delen', 'text' => 'Smalle delen geven een fijn, druk beeld; bredere delen een rustiger vlak. We bekijken het op de schaal van uw gevel, niet op een staal van dertig centimeter.'],
                ['title' => 'Aansluiting rond openingen', 'text' => 'Rond ramen, deuren en poorten valt of staat het resultaat. Hoe die randen opgelost worden, spreken we vooraf af.'],
                ['title' => 'Afwerking', 'text' => 'Onbehandeld laten vergrijzen, gebeitst of geschilderd. Dat is geen detail: de keuze bepaalt zowel het eindbeeld als wat er later aan onderhoud bijkomt.'],
                ['title' => 'Combinatie met ander schrijnwerk', 'text' => 'Wanneer we ook uw ramen, deuren of poort maken, kunnen houtsoort en afwerking gelijk lopen.'],
            ],

            'werkwijze_intro' => 'Voor gevelbekleding verloopt een opdracht zo:',

            'materials' => [
                'De keuze van houtsoort en afwerking hangt af van de oriëntatie van de gevel, van de mate waarin ze beschut is en van het beeld dat u wil. Een noordgevel vergrijst anders dan een zuidgevel, en dat is geen probleem zolang u het op voorhand weet.',
                'Over levensduur, vergrijzingssnelheid en onderhoudsintervallen geven we geen cijfers die we niet kunnen hardmaken. Wel bespreken we eerlijk wat een keuze in uw situatie waarschijnlijk betekent — ook wanneer dat betekent dat u beter iets anders kiest.',
            ],

            'faq' => [
                ['q' => 'Kan gevelbekleding op een bestaande gevel?', 'a' => 'Vaak wel, maar dat hangt af van wat eronder zit. Bij de opmeting bekijken we de bestaande opbouw en de aansluitingen voor we iets voorstellen.'],
                ['q' => 'Hoe zit het met de aansluiting rond ramen en deuren?', 'a' => 'Dat is het belangrijkste deel van het werk. Wanneer we ook het buitenschrijnwerk uitvoeren, kunnen we die randen meteen goed oplossen in plaats van er achteraf iets rond te passen.'],
                ['q' => 'Moet houten gevelbekleding behandeld worden?', 'a' => 'Dat is een keuze, geen verplichting. Onbehandeld hout vergrijst; behandeld hout houdt langer zijn kleur maar vraagt opvolging. We overlopen wat bij uw gevel past.'],
                ['q' => 'Kunnen jullie ook een carport of berging bekleden?', 'a' => 'Ja. Houtconstructies en bekleding voor carports, overkappingen en bijgebouwen horen bij ons werk.'],
                ['q' => 'Kan ik een deel van de gevel bekleden?', 'a' => 'Zeker. Vaak wordt maar één gevelvlak of één volume in hout uitgevoerd, juist om het te laten opvallen.'],
                ['q' => 'Wat hebben jullie nodig om een prijs te kunnen maken?', 'a' => 'Foto\'s van de gevel en, als u ze hebt, de afmetingen. Hoe concreter het beeld, hoe sneller we kunnen zeggen wat haalbaar is.'],
                ['q' => 'Werken jullie samen met de aannemer of de architect?', 'a' => 'Regelmatig, en bij gevelbekleding is dat vaak ook nodig: de opbouw achter het hout, de isolatie en de aansluitingen raken aan het werk van anderen. Die afstemming nemen we op ons.'],
            ],

            'cta_heading' => 'Een houten gevel voor uw woning?',
            'cta_text'    => 'Stuur ons foto\'s van de gevel en een korte omschrijving van wat u voor ogen hebt.',
        ],

    ],

];
