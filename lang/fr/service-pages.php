<?php

return [

    /*
     * Libellés partagés. Le déroulement d'un chantier se trouve dans
     * lang/fr/werkwijze.php, pour que les pages régionales et les pages de
     * services affichent exactement les mêmes étapes.
     */
    'common' => [
        'eyebrow'         => 'Service',
        'breadcrumb_aria' => 'Fil d\'Ariane',
        'breadcrumb_home' => 'Accueil',

        'cta_contact'   => 'Demander un prix',
        'cta_secondary' => 'En savoir plus : :service',

        'when_heading'      => 'Dans quels cas est-ce intéressant ?',
        'options_heading'   => 'Possibilités et choix',
        'materials_heading' => 'Matériaux et finition',

        'realisaties_heading' => 'Un aperçu de notre travail',
        'realisaties_note'    => 'Photos de chantiers antérieurs. Elles illustrent notre travail en général ; chaque photo n\'est pas nécessairement un exemple de cette exécution précise.',
        'realisatie_alt'      => 'Menuiserie Van Kerkhoven — photo :n sur :m',

        'faq_heading' => 'Questions fréquentes',

        'related_heading' => 'Services liés',
        'related_link'    => 'Vers :service',

        // Bloc compact en bas des pages de services principales existantes
        'subservices_heading' => 'Plus en détail',
        'subservices_intro'   => 'Des pages distinctes consacrées à des volets de ce service.',
        'subservices_link'    => 'Lire la suite',
    ],

    'items' => [

        /* ── Portes intérieures ─────────────────────────────────────────── */
        'binnendeuren' => [
            'name'             => 'Portes intérieures',
            'teaser'           => 'Des portes qui participent à l\'organisation et à l\'ambiance de votre intérieur — sur mesure, dans des huisseries existantes ou neuves.',
            'meta_title'       => 'Portes intérieures sur mesure en bois | Van Kerkhoven',
            'meta_description' => 'Portes intérieures sur mesure en bois massif, ajustées à vos huisseries, vos sols et votre intérieur. Fabriquées et posées par notre atelier à Huldenberg.',
            'h1'               => 'Portes intérieures sur mesure',
            'hero_intro'       => 'Une porte intérieure participe à la manière dont une pièce se ressent. Nous les fabriquons sur mesure des huisseries en place — ou de celles à venir.',
            'service_type'     => 'Portes intérieures sur mesure',

            'what_heading' => 'Ce que recouvre une porte intérieure sur mesure',
            'what'         => [
                'Une porte intérieure sur mesure, ce n\'est pas simplement un panneau d\'une autre largeur. Il s\'agit du panneau, de l\'huisserie, de la feuillure, de la quincaillerie et de la façon dont l\'ensemble rejoint le sol et le mur. Ces éléments décident ensemble si une porte ferme correctement — et si elle le fera encore dans dix ans.',
                'Chez nous, cet ensemble est fabriqué dans notre propre atelier. Nous partons de l\'ouverture réelle : un tableau maçonné a rarement la même largeur partout, un niveau de sol varie d\'une pièce à l\'autre, et en rénovation une huisserie existante n\'est souvent plus tout à fait d\'aplomb. Qui aborde cela avec des dimensions standard doit combler après coup.',
                'Nous réalisons des portes simples et doubles, avec ou sans vitrage, et avec l\'encadrement de votre choix : un chambranle classique, une baguette fine, ou un raccord qui disparaît dans l\'enduit. Une porte montant jusqu\'au plafond est techniquement un chantier comme un autre — elle demande simplement plus de préparation.',
            ],
            'highlights' => [
                'Panneau, huisserie, feuillure et quincaillerie comme un tout',
                'Relevé dans l\'ouverture existante',
                'Simple ou double, avec ou sans vitrage',
                'Fabriquées et posées par nos propres équipes',
            ],

            'when' => [
                ['title' => 'En rénovation', 'text' => 'Les huisseries restent, mais les portes sont usées ou ne s\'accordent plus à la nouvelle finition. Nous relevons chaque huisserie séparément et fabriquons des panneaux qui tombent dans la feuillure existante.'],
                ['title' => 'Lors d\'une redistribution', 'text' => 'Un mur disparaît, une pièce est divisée, un passage se déplace. Huisserie et porte sont alors neuves, ajustées à la nouvelle finition de sol.'],
                ['title' => 'En construction neuve', 'text' => 'Les cotes figurent au plan, l\'exécution pas encore. Hauteur, profil d\'huisserie et finition se discutent avant la mise en fabrication.'],
                ['title' => 'Pour une seule porte à remplacer', 'text' => 'Une seule porte est possible aussi. Nous cherchons alors un profil qui s\'accorde aux portes qui restent, pour que la nouvelle ne détonne pas.'],
            ],

            'options' => [
                ['title' => 'Panneau plat ou à panneaux', 'text' => 'Un panneau plat convient à un intérieur épuré ; une porte à panneaux s\'accorde aux maisons anciennes et aux portes existantes conservées. Nous réalisons les deux en bois massif.'],
                ['title' => 'Hauteur et proportions', 'text' => 'Une hauteur standard est une habitude, pas une obligation. Une porte montant jusqu\'au plafond change sensiblement les proportions d\'un couloir ou d\'une pièce de vie.'],
                ['title' => 'Huisserie et chambranle', 'text' => 'Un chambranle visible, une baguette fine ou un raccord affleurant — le choix décide du caractère plus ou moins marqué de la porte dans le mur.'],
                ['title' => 'Vitrage ou plein', 'text' => 'Le vitrage apporte de la lumière dans un couloir sans fenêtre. Nous discutons alors au préalable de la répartition du vitrage et de la largeur des parties qui l\'entourent.'],
                ['title' => 'Sens d\'ouverture et quincaillerie', 'text' => 'Le sens d\'ouverture détermine l\'usage d\'une pièce. Vous choisissez la quincaillerie avec nous ; nous veillons à ce que feuillure et paumelles soient calculées pour le poids du panneau.'],
                ['title' => 'Finition', 'text' => 'Huilée, vernie ou peinte. Ce qui convient le mieux dépend du reste de l\'intérieur et de l\'entretien que vous acceptez. Nous passons les options en revue sur échantillons.'],
            ],

            'werkwijze_intro' => 'Pour des portes intérieures, le parcours se présente ainsi :',

            'materials' => [
                'Nous travaillons le bois massif. L\'essence qui convient dépend de l\'aspect recherché, de la finition prévue et du poids acceptable pour le panneau. Une porte montant jusqu\'au plafond n\'est pas une porte de débarras étroite.',
                'La finition se discute sur échantillons, pas sur photo. Couleur et brillance ne rendent pas la même chose en vrai qu\'à l\'écran — surtout sur du bois, où le fil reste présent dans le résultat final.',
            ],

            'faq' => [
                ['q' => 'Pouvez-vous fabriquer des portes pour des huisseries existantes ?', 'a' => 'Oui, cela représente une bonne part du travail. Nous relevons l\'huisserie et fabriquons le panneau en conséquence. Si une huisserie n\'est plus d\'équerre, nous en tenons compte dans les cotes.'],
                ['q' => 'Fabriquez-vous aussi les huisseries ?', 'a' => 'Oui. En construction neuve ou lors d\'une redistribution, nous livrons huisserie et porte comme un tout, pour que feuillure et finition s\'accordent.'],
                ['q' => 'Puis-je faire réaliser une seule porte ?', 'a' => 'C\'est possible. Nous abordons les petits chantiers comme les grands ; seul le délai dépend de ce qui est en fabrication à ce moment-là.'],
                ['q' => 'Qu\'en est-il du jeu par rapport au sol ?', 'a' => 'Nous le déterminons seulement une fois la finition de sol arrêtée. Sinon le jeu en bas ne convient plus, ou la porte accroche sur un tapis ou un seuil.'],
                ['q' => 'Fournissez-vous aussi la quincaillerie ?', 'a' => 'Nous en discutons avec vous, pour que paumelles et serrure correspondent au poids et à l\'usage de la porte. Ce que vous fournissez vous-même, nous pouvons évidemment le poser.'],
                ['q' => 'Combien de temps avant que les portes soient posées ?', 'a' => 'Cela dépend du nombre de portes et du planning de l\'atelier. Nous indiquons dans le devis ce qui est réaliste à ce moment-là ; nous préférons annoncer un délai tenable qu\'un délai court.'],
            ],

            'cta_heading' => 'Des portes intérieures pour votre habitation ?',
            'cta_text'    => 'Envoyez-nous les cotes ou des photos des huisseries existantes. Nous vous dirons ce qui est possible et ce que cela implique.',
        ],

        /* ── Portes extérieures ─────────────────────────────────────────── */
        'buitendeuren' => [
            'name'             => 'Portes extérieures',
            'teaser'           => 'La porte d\'entrée est la première chose qu\'un visiteur voit — et l\'élément le plus exposé.',
            'meta_title'       => 'Portes extérieures sur mesure en bois | Van Kerkhoven',
            'meta_description' => 'Portes d\'entrée et de service sur mesure en bois massif, accordées à votre façade et au reste des menuiseries. Fabriquées et posées par nos soins.',
            'h1'               => 'Portes extérieures sur mesure',
            'hero_intro'       => 'Une porte extérieure doit avoir belle allure et fonctionner chaque jour, des années durant, par tous les temps. Nous les réalisons sur mesure de votre façade.',
            'service_type'     => 'Portes extérieures sur mesure',

            'what_heading' => 'Ce que recouvre une porte extérieure sur mesure',
            'what'         => [
                'Une porte extérieure se situe à la limite entre dedans et dehors, et en subit tout : pluie, soleil, écarts de température et usage quotidien. Les exigences ne sont pas celles d\'une porte intérieure. La composition du panneau, le raccord au seuil et la manière dont l\'eau est évacuée pèsent ici plus lourd que l\'esthétique.',
                'C\'est pourtant l\'élément que les visiteurs regardent en premier. Une porte d\'entrée qui ne s\'accorde pas à la façade se remarque immédiatement — et celle qui s\'y accorde, justement, ne se remarque pas. Nous partons donc de la façade : l\'ouverture existante, les matériaux alentour et les menuiseries déjà en place.',
                'Nous réalisons portes d\'entrée, portes de service et portes de débarras, avec ou sans imposte ni fixe latéral. En rénovation, nous relevons l\'ouverture existante ; en construction neuve, nous accordons les cotes avec l\'entrepreneur ou l\'architecte, de préférence avant que la maçonnerie ne soit terminée.',
            ],
            'highlights' => [
                'Portes d\'entrée, de service et de débarras',
                'Accordées à la façade et aux autres menuiseries extérieures',
                'Raccord au seuil et évacuation d\'eau examinés',
                'Pose par notre propre équipe',
            ],

            'when' => [
                ['title' => 'En remplacement', 'text' => 'La porte existante ferme mal, s\'est déformée ou ne convient plus à une façade rénovée. Nous relevons l\'ouverture et construisons la nouvelle porte autour.'],
                ['title' => 'Lors d\'une rénovation de façade', 'text' => 'Quand fenêtres et portes sont remplacées ensemble, profil, essence et finition peuvent s\'accorder. L\'image de la façade est bien plus calme qu\'en remplaçant pièce par pièce.'],
                ['title' => 'En construction neuve', 'text' => 'L\'ouverture figure au plan, l\'exécution pas encore. Plus nous intervenons tôt, plus les raccords seront simples à réaliser ensuite.'],
                ['title' => 'Pour une annexe ou un débarras', 'text' => 'Une porte de garage, d\'abri de jardin ou de remise peut aussi reprendre l\'essence et la finition du reste, pour que l\'ensemble tienne debout visuellement.'],
            ],

            'options' => [
                ['title' => 'Pleine ou vitrée', 'text' => 'Un panneau plein ferme, le vitrage apporte de la lumière dans le hall. C\'est souvent une combinaison : une partie basse pleine avec un vitrage ou une imposte au-dessus.'],
                ['title' => 'Classique ou épurée', 'text' => 'Une porte à panneaux moulurés s\'accorde aux façades anciennes ; un panneau plat avec poignée verticale à l\'architecture contemporaine. Nous façonnons nos profils, vous n\'êtes donc pas lié à un catalogue.'],
                ['title' => 'Fixe latéral et imposte', 'text' => 'Si l\'ouverture est plus large ou plus haute qu\'un vantail, l\'ensemble est divisé. La façon dont cette division se lit détermine fortement l\'image de la façade.'],
                ['title' => 'Quincaillerie et fermeture', 'text' => 'Poignées, paumelles et serrurerie se choisissent avec vous. Nous les accordons au poids du panneau et à l\'intensité d\'usage.'],
                ['title' => 'Finition', 'text' => 'Une menuiserie extérieure demande une finition qui supporte soleil et pluie. Ce qui est judicieux chez vous dépend de l\'orientation de la façade et de l\'entretien que vous acceptez — nous en parlons franchement.'],
            ],

            'werkwijze_intro' => 'Pour une porte extérieure, un chantier se déroule ainsi :',

            'materials' => [
                'Nous travaillons le bois massif. L\'essence se choisit en concertation, selon l\'implantation de la porte, son degré d\'abri et la finition prévue. Une porte au sud sans auvent n\'appelle pas les mêmes conventions qu\'une porte dans une entrée abritée.',
                'Sur la durée de vie et les intervalles d\'entretien, nous ne faisons pas de promesses sur papier. En revanche, nous disons d\'avance ce qu\'un choix implique en pratique, pour vous éviter les surprises.',
            ],

            'faq' => [
                ['q' => 'Pouvez-vous remplacer une porte d\'entrée sans toucher à la façade ?', 'a' => 'Le plus souvent, oui. Nous relevons l\'ouverture et les points d\'appui existants et construisons la nouvelle porte autour. Ce n\'est que si la maçonnerie ou le seuil ne sont plus en état que cela va plus loin ; nous le disons lors du relevé.'],
                ['q' => 'Porte et fenêtres peuvent-elles être dans le même style ?', 'a' => 'Oui, et c\'est généralement le conseil. Lorsque nous réalisons l\'ensemble des menuiseries extérieures, nous gardons profil, essence et finition identiques.'],
                ['q' => 'Réalisez-vous des portes avec fixe latéral ou imposte ?', 'a' => 'Oui. Pour les ouvertures plus larges ou plus hautes, nous divisons l\'ensemble ; cette division se discute au préalable, car elle marque fortement la façade.'],
                ['q' => 'Qu\'en est-il de la sécurité de la porte ?', 'a' => 'Serrurerie et quincaillerie se discutent avec vous. La solution pertinente dépend de la situation ; nous n\'annonçons pas de classes de résistance que nous ne pouvons pas garantir.'],
                ['q' => 'Quel entretien demande une porte extérieure en bois ?', 'a' => 'Cela dépend de la finition et du degré d\'exposition. Lors de l\'entretien, nous vous disons ce qui est réaliste dans votre situation.'],
                ['q' => 'Posez-vous la porte vous-mêmes ?', 'a' => 'Oui, avec notre propre équipe de pose. Un seul interlocuteur reste ainsi responsable du panneau, de l\'huisserie et des raccords.'],
            ],

            'cta_heading' => 'Une nouvelle porte extérieure ?',
            'cta_text'    => 'Envoyez-nous une photo de la façade et de l\'ouverture existantes. Nous vous dirons ce qui est possible.',
        ],

        /* ── Fenêtres en bois ───────────────────────────────────────────── */
        'houten-ramen' => [
            'name'             => 'Fenêtres en bois',
            'teaser'           => 'Des fenêtres en bois massif, relevées dans l\'ouverture existante et accordées à l\'architecture de la maison.',
            'meta_title'       => 'Fenêtres en bois massif sur mesure | Van Kerkhoven',
            'meta_description' => 'Fenêtres en bois sur mesure pour rénovation et construction neuve. Profil, répartition et finition accordés à votre façade, fabriqués dans notre atelier.',
            'h1'               => 'Fenêtres en bois sur mesure',
            'hero_intro'       => 'Le bois donne à une façade ce que d\'autres matériaux atteignent difficilement : un profil qui a de la profondeur et un fil qui vit avec la lumière.',
            'service_type'     => 'Fenêtres en bois sur mesure',

            'what_heading' => 'Ce que recouvrent des fenêtres en bois sur mesure',
            'what'         => [
                'Une fenêtre sur mesure part de l\'ouverture, pas d\'un catalogue. Nous relevons chaque baie séparément — en rénovation, à plusieurs hauteurs, car un tableau maçonné est rarement parfaitement droit. Sur base de ces cotes, nous dessinons la répartition, le profil et les raccords.',
                'La fenêtre est ensuite fabriquée dans notre propre atelier : le bois est raboté, les profils fraisés, les assemblages réalisés et l\'ensemble fini. Comme un profil est chez nous un réglage et non une référence d\'article, la fenêtre peut prendre la forme que la façade demande, et non l\'inverse.',
                'Nous travaillons aussi bien en rénovation — où l\'image existante de la façade sert de point de départ — qu\'en construction neuve, où les cotes peuvent encore s\'accorder avec l\'entrepreneur ou l\'architecte.',
            ],
            'highlights' => [
                'Chaque baie relevée séparément',
                'Profil et répartition sur mesure, hors catalogue',
                'Rénovation et construction neuve',
                'Atelier et équipe de pose en propre',
            ],

            'when' => [
                ['title' => 'En rénovation d\'une maison ancienne', 'text' => 'Les fenêtres existantes sont usées, mais l\'image de la façade doit tenir. Nous prenons la répartition et la profondeur de profil existantes comme point de départ, dans une exécution contemporaine.'],
                ['title' => 'Quand l\'image de la rue compte', 'text' => 'Dans une rue où les façades forment ensemble le paysage, la répartition de la fenêtre pèse plus lourd que le matériau. Le bois autorise des divisions fines sans alourdir le profil.'],
                ['title' => 'En construction neuve, pour la chaleur', 'text' => 'Le bois est souvent retenu en neuf également — précisément parce qu\'il donne, côté intérieur, autre chose qu\'un profil plat et froid.'],
                ['title' => 'Pour un remplacement par phases', 'text' => 'La façade à rue d\'abord, la façade jardin ensuite. Comme nous avons réalisé le travail précédent, nous savons quel profil et quelle finition avaient été retenus.'],
            ],

            'options' => [
                ['title' => 'Répartition et division', 'text' => 'Parties fixes, ouvrants, oscillo-battants, division à petits-bois. Votre choix détermine l\'aspect autant que le confort d\'usage ; nous le dessinons avant toute fabrication.'],
                ['title' => 'Profondeur de profil', 'text' => 'Un profil fin allège l\'image de la façade, un profil plus marqué s\'accorde mieux aux maisons anciennes. Chez nous, c\'est un choix, pas une limite du système.'],
                ['title' => 'Vitrage', 'text' => 'Le vitrage qui convient se discute au vu de l\'existant et de ce que vous voulez obtenir. Nous n\'apposons pas de chiffres de performance sur un projet que nous n\'avons pas encore vu.'],
                ['title' => 'Finition', 'text' => 'Peinte, vernie ou finie de manière transparente, le fil restant alors visible. Le choix va de pair avec l\'aspect recherché et l\'entretien.'],
                ['title' => 'Raccords', 'text' => 'Seuils, finition intérieure et isolation font partie de la fenêtre. Lors du relevé, nous examinons le raccord complet, pas seulement le dormant.'],
            ],

            'werkwijze_intro' => 'Pour des fenêtres en bois, cela se déroule ainsi :',

            'materials' => [
                'Nous travaillons le bois massif. L\'essence qui convient dépend de l\'orientation de la façade, de la finition souhaitée et de l\'entretien que vous acceptez. Aucune essence n\'est la meilleure dans toutes les situations, et nous ne faisons pas semblant du contraire.',
                'Échantillons et sections de profil peuvent être examinés à l\'atelier sur rendez-vous. En vrai, une essence et une couleur se choisissent bien plus facilement qu\'à l\'écran.',
            ],

            'faq' => [
                ['q' => 'Travaillez-vous sur dimensions standard ?', 'a' => 'Non. Chaque baie est relevée séparément. En rénovation, il n\'y en a pratiquement pas deux identiques, et même en neuf l\'exécution s\'écarte souvent du plan.'],
                ['q' => 'Une fenêtre neuve peut-elle s\'accorder à une façade ancienne ?', 'a' => 'C\'est souvent exactement la mission. Nous partons de la répartition et de la profondeur de profil existantes et les exécutons avec vitrage et quincaillerie actuels.'],
                ['q' => 'Remplacez-vous aussi une seule fenêtre ?', 'a' => 'Oui. Nous tenons alors compte des fenêtres qui restent, pour que la nouvelle ne détonne pas dans la façade.'],
                ['q' => 'Réalisez-vous aussi la finition intérieure ?', 'a' => 'Lors du relevé, nous examinons le raccord complet : seuil, isolation et finition intérieure. Ce que nous prenons en charge se convient à l\'avance, pour éviter les trous dans le planning.'],
                ['q' => 'Quelle différence avec des fenêtres en aluminium ?', 'a' => 'En bref : le bois offre plus de liberté dans le profil et une image plus chaleureuse, l\'aluminium un dessin plus épuré et plus fin. Le matériau qui convient dépend de l\'architecture et de l\'entretien souhaité.'],
                ['q' => 'Puis-je voir un échantillon de l\'essence et de la finition ?', 'a' => 'Oui, sur rendez-vous à l\'atelier à Huldenberg. Emportez un nuancier ou une photo de votre façade : côte à côte, on voit tout de suite ce qui s\'accorde.'],
            ],

            'cta_heading' => 'Des fenêtres en bois pour votre habitation ?',
            'cta_text'    => 'Envoyez-nous des photos de la façade existante et une courte description. Nous examinons ce qui est possible.',
        ],

        /* ── Fenêtres en aluminium ──────────────────────────────────────── */
        'aluminium-ramen' => [
            'name'             => 'Fenêtres en aluminium',
            'teaser'           => 'Un profil fin et épuré, pour qui cherche une image contemporaine et de grandes surfaces vitrées.',
            'meta_title'       => 'Fenêtres en aluminium sur mesure | Van Kerkhoven',
            'meta_description' => 'Fenêtres en aluminium sur mesure pour architecture contemporaine et grandes surfaces vitrées. Relevé, conseil et pose par Van Kerkhoven à Huldenberg.',
            'h1'               => 'Fenêtres en aluminium sur mesure',
            'hero_intro'       => 'Là où une façade demande un profil fin et une grande surface vitrée, l\'aluminium est souvent le choix logique.',
            'service_type'     => 'Fenêtres en aluminium sur mesure',

            'what_heading' => 'Ce que recouvrent des fenêtres en aluminium sur mesure',
            'what'         => [
                'Van Kerkhoven est avant tout une menuiserie : l\'essentiel de ce que nous fabriquons est du bois massif, issu de notre propre atelier. Tous les projets n\'appellent pourtant pas le bois. Lorsqu\'une façade demande un profil résolument fin ou une très grande surface vitrée, l\'aluminium est généralement la meilleure réponse.',
                'L\'approche ne change pas. Nous partons de l\'ouverture et de ce que vous voulez obtenir, pas d\'une liste de produits. Nous relevons sur place, discutons de la répartition et du mode d\'ouverture, et veillons à ce que le raccord à la façade et à la finition intérieure soit correct.',
                'Il s\'agit souvent d\'une combinaison : du bois là où l\'image et la chaleur comptent, de l\'aluminium là où le profil doit rester le plus fin possible. Cela ne pose pas de problème, à condition que le choix soit conscient et ne varie pas d\'une façade à l\'autre.',
            ],
            'highlights' => [
                'Pour l\'architecture contemporaine et les grandes surfaces vitrées',
                'Relevé dans la situation existante',
                'Également en combinaison avec de la menuiserie en bois',
                'Un seul interlocuteur, de l\'entretien à la pose',
            ],

            'when' => [
                ['title' => 'Pour une construction neuve contemporaine', 'text' => 'Lorsque le projet repose sur un profil visible minimal et de grandes surfaces vitrées continues.'],
                ['title' => 'Pour une extension ou une annexe', 'text' => 'Une nouvelle pièce de vie accolée à une habitation existante prend souvent volontairement un autre caractère. L\'aluminium souligne cette différence.'],
                ['title' => 'Quand l\'entretien pèse lourd', 'text' => 'Qui veut réduire au minimum l\'entretien des menuiseries extérieures arrive souvent à l\'aluminium. Ce que cela signifie concrètement se discute au vu de votre situation.'],
                ['title' => 'Pour une combinaison de matériaux', 'text' => 'Du bois côté rue, de l\'aluminium côté jardin — ou l\'inverse. Nous accordons couleurs et divisions pour que l\'ensemble tienne.'],
            ],

            'options' => [
                ['title' => 'Répartition et mode d\'ouverture', 'text' => 'Parties fixes, ouvrants ou oscillo-battants, ou une solution coulissante. Le choix détermine l\'usage autant que la quantité de profil visible.'],
                ['title' => 'Couleur et finition', 'text' => 'La couleur de finition se discute ensemble ; elle décide largement si la menuiserie s\'affirme ou s\'efface dans la façade.'],
                ['title' => 'Rapport à la surface vitrée', 'text' => 'Plus la surface vitrée est grande, plus la structure et la quincaillerie doivent être dimensionnées. Ce qui est réalisable chez vous s\'examine lors du relevé.'],
                ['title' => 'Combinaison avec le bois', 'text' => 'Aluminium et bois côte à côte, c\'est possible, à condition d\'accorder divisions et couleurs. C\'est exactement le genre d\'arbitrage auquel nous consacrons du temps en amont.'],
                ['title' => 'Raccord à la façade', 'text' => 'Seuils, isolation et finition intérieure font partie de la fenêtre. Nous examinons le raccord complet, pas seulement le profil.'],
            ],

            'werkwijze_intro' => 'Pour l\'aluminium aussi, nous suivons le même parcours :',

            'materials' => [
                'Sur les performances techniques — valeurs d\'isolation, atténuation acoustique, résistance à l\'effraction — nous ne nous prononçons volontairement pas sur cette page. Elles dépendent de l\'exécution concrète, et apposer des chiffres avant d\'avoir vu votre projet n\'aurait aucun sens.',
                'Ce que nous faisons : déterminer ensemble ce que la façade et l\'usage demandent, et bâtir une proposition là-dessus. Si le bois se révèle le meilleur choix dans votre cas, nous le disons aussi.',
            ],

            'faq' => [
                ['q' => 'Fabriquez-vous les fenêtres en aluminium dans votre atelier ?', 'a' => 'Notre atelier est équipé pour le bois massif. La façon dont un chantier en aluminium se déroule concrètement chez nous se discute au préalable, pour que ce que nous prenons en charge soit clair d\'avance.'],
                ['q' => 'Puis-je combiner bois et aluminium dans la même habitation ?', 'a' => 'Oui, et cela arrive plus souvent qu\'on ne le pense : du bois là où l\'image compte, de l\'aluminium là où le profil doit rester le plus fin possible. Nous accordons couleurs et divisions.'],
                ['q' => 'Quelle valeur d\'isolation atteignent les fenêtres en aluminium ?', 'a' => 'Cela dépend entièrement de l\'exécution et du vitrage. Nous n\'avançons pas de chiffre à l\'avance ; le devis reprend les données correspondant à l\'exécution retenue.'],
                ['q' => 'L\'aluminium est-il sans entretien ?', 'a' => 'Peu exigeant en entretien est plus honnête que sans entretien. Ce que cela demande en pratique dépend de l\'implantation et de la finition ; nous en parlons concrètement.'],
                ['q' => 'Peut-on remplacer des fenêtres existantes par de l\'aluminium ?', 'a' => 'C\'est possible, mais pas toujours le meilleur choix. Sur une façade ancienne, un profil fin donne parfois une image qui ne convient pas à la maison. Nous le disons quand c\'est notre avis.'],
                ['q' => 'Comment demander une proposition ?', 'a' => 'Via le formulaire de contact, de préférence avec des photos de la situation et une courte description de ce que vous envisagez. Nous vous dirons ce dont nous avons besoin pour avancer.'],
                ['q' => 'Pouvez-vous aussi livrer de grands coulissants vitrés ?', 'a' => 'Cela dépend des dimensions et de ce que la structure permet. Sur de grands vantaux coulissants, le poids et le guidage déterminent le réalisable ; nous l\'examinons lors du relevé sur place.'],
            ],

            'cta_heading' => 'Un projet avec de la menuiserie en aluminium ?',
            'cta_text'    => 'Dites-nous ce que vous envisagez et de quoi il s\'agit. Nous examinons ensemble quel matériau convient le mieux.',
        ],

        /* ── Portes de garage ───────────────────────────────────────────── */
        'garagepoorten' => [
            'name'             => 'Portes de garage',
            'teaser'           => 'Une porte utilisée tous les jours et qui occupe en même temps une grande part de la façade.',
            'meta_title'       => 'Portes de garage sur mesure en bois | Van Kerkhoven',
            'meta_description' => 'Portes de garage en bois sur mesure, intégrées dans l\'ouverture existante de la façade. Du relevé à la pose par Van Kerkhoven à Huldenberg.',
            'h1'               => 'Portes de garage sur mesure',
            'hero_intro'       => 'Une porte de garage constitue d\'emblée l\'une des plus grandes surfaces de la façade. Elle doit donc fonctionner et s\'accorder au reste.',
            'service_type'     => 'Portes de garage sur mesure',

            'what_heading' => 'Ce que recouvre une porte de garage sur mesure',
            'what'         => [
                'Une porte de garage se distingue des autres menuiseries extérieures sur deux points : les dimensions et l\'usage. Elle est grande, elle pèse, et elle s\'ouvre et se ferme quotidiennement. La structure et la quincaillerie comptent donc au moins autant que l\'aspect.',
                'Pour un portail, nous partons dès lors de l\'ouverture et des points d\'appui. Une porte dans une allée dégagée n\'affronte pas le vent comme une porte entre deux murs, et une ouverture maçonnée dans une maison ancienne a rarement la même largeur partout. Nous relevons ces cotes nous-mêmes.',
                'Par ailleurs, la porte détermine une grande part de l\'image de la façade. Il est souvent payant d\'exécuter la porte, la porte de service voisine et le reste des menuiseries dans la même essence et la même finition, pour que la façade reste un tout.',
            ],
            'highlights' => [
                'Relevée dans l\'ouverture existante',
                'Structure et quincaillerie dimensionnées pour le poids',
                'Finition accordable au reste de la façade',
                'Pose et réglage par notre propre équipe',
            ],

            'when' => [
                ['title' => 'Pour une porte usée', 'text' => 'La porte penche, ne ferme plus, ou le bois est fini. Nous relevons l\'ouverture à neuf plutôt que de nous fier aux cotes de l\'ancienne porte.'],
                ['title' => 'Lors d\'une rénovation de façade', 'text' => 'Si la façade est de toute façon reprise, c\'est le moment d\'accorder porte de garage, porte et fenêtres.'],
                ['title' => 'Pour une ferme ou une annexe transformée', 'text' => 'Les grandes ouvertures des bâtiments anciens demandent une structure calculée pour la portée. C\'est là que le sur-mesure fait la différence.'],
                ['title' => 'En construction neuve', 'text' => 'L\'ouverture figure au plan ; plus nous intervenons tôt, plus le raccord à la maçonnerie et au seuil sera simple.'],
            ],

            'options' => [
                ['title' => 'Mode d\'ouverture', 'text' => 'Battante en deux vantaux ou une autre solution adaptée à l\'ouverture. Ce qui est possible chez vous dépend de l\'ouverture, de l\'allée et de l\'espace intérieur ; nous l\'examinons sur place.'],
                ['title' => 'Division de la surface', 'text' => 'Parties verticales, ligne horizontale ou surface sans division apparente. Sur une grande surface, ce choix se voit immédiatement.'],
                ['title' => 'Quincaillerie', 'text' => 'Paumelles, serrurerie et guidage se choisissent selon le poids et l\'usage quotidien. Sur un portail, ce n\'est pas un détail.'],
                ['title' => 'Raccord à la façade', 'text' => 'Une porte de garage est rarement seule : une porte à côté, un seuil dessous, de la maçonnerie autour. Ces raccords décident de la durée pendant laquelle l\'ensemble reste beau.'],
                ['title' => 'Finition', 'text' => 'Peinte, lasurée ou finie de manière transparente. Ce qui est judicieux dépend de l\'implantation et de l\'exposition ; nous en parlons avant que le choix ne soit arrêté.'],
            ],

            'werkwijze_intro' => 'Pour une porte de garage, le parcours se présente ainsi :',

            'materials' => [
                'Nous travaillons le bois massif. Sur un portail, la composition pèse plus lourd encore : une grande surface qui bouge chaque jour doit rester stable. Cela oriente le choix de l\'essence et de la construction.',
                'Sur une commande motorisée, nous ne faisons pas de promesses sur cette page. Si vous le souhaitez, abordez-le dès le premier contact, pour que ce que nous prenons en charge soit clair immédiatement.',
            ],

            'faq' => [
                ['q' => 'Relevez-vous l\'ouverture existante ?', 'a' => 'Toujours. Nous relevons nous-mêmes l\'ouverture, les points d\'appui et le niveau de sol ; les cotes de l\'ancienne porte sont rarement encore exactes.'],
                ['q' => 'La porte peut-elle recevoir la même finition que le reste de la menuiserie ?', 'a' => 'Oui, et c\'est généralement le conseil. Porte de garage, porte et fenêtres dans la même essence et la même finition donnent une façade bien plus calme.'],
                ['q' => 'Pouvez-vous réaliser un portail pour une grande ouverture dans une ferme ou une annexe ?', 'a' => 'C\'est possible. Sur les grandes portées, c\'est la structure qui décide du résultat ; nous examinons sur place ce qui est réalisable.'],
                ['q' => 'Livrez-vous aussi des portes motorisées ?', 'a' => 'Abordez-le dès le premier contact. Nous vous dirons immédiatement ce que nous pouvons prendre en charge dans votre cas, plutôt que de devoir l\'ajuster après coup.'],
                ['q' => 'Quel entretien demande une porte en bois ?', 'a' => 'Cela dépend de l\'implantation et de la finition. Une porte au sud sans abri demande plus de suivi qu\'une porte à l\'ombre. Nous disons d\'avance ce à quoi vous attendre.'],
                ['q' => 'Posez-vous le portail vous-mêmes ?', 'a' => 'Oui, avec notre propre équipe de pose — réglage après installation compris.'],
                ['q' => 'Une porte de service peut-elle venir à côté du portail ?', 'a' => 'Oui, c\'est une combinaison très demandée : une porte de service à côté du portail, dans la même essence et la même finition, pour ne pas devoir ouvrir tout le portail à chaque fois.'],
            ],

            'cta_heading' => 'Une nouvelle porte de garage ?',
            'cta_text'    => 'Envoyez-nous une photo de l\'ouverture et de la façade, avec les cotes si vous les avez. Nous vous dirons ce qui est possible.',
        ],

        /* ── Armoires sur mesure ────────────────────────────────────────── */
        'maatkasten' => [
            'name'             => 'Armoires sur mesure',
            'teaser'           => 'Des armoires encastrées qui épousent l\'espace réel — y compris sous une pente ou dans un angle perdu.',
            'meta_title'       => 'Armoires encastrées et sur mesure | Van Kerkhoven',
            'meta_description' => 'Armoires encastrées sur mesure pour murs en pente, niches et angles perdus. Conçues, fabriquées et posées par Van Kerkhoven à Huldenberg.',
            'h1'               => 'Armoires sur mesure',
            'hero_intro'       => 'Une armoire sur mesure remplit l\'espace qui existe réellement — y compris la pente, la niche et l\'angle où rien de standard n\'entre.',
            'service_type'     => 'Armoires sur mesure et agencement intérieur',

            'what_heading' => 'Ce qu\'apporte le sur-mesure en matière d\'armoires',
            'what'         => [
                'La différence entre une armoire sur mesure et une armoire du commerce tient aux centimètres qu\'on ne voit pas. Une armoire standard laisse un jour sur le côté, une couche de poussière au-dessus et une bande perdue à l\'arrière. Dans une armoire encastrée, cet espace n\'existe pas : l\'armoire est l\'espace.',
                'Cela devient vraiment intéressant là où l\'espace n\'est pas rectangulaire. Sous une pente de toit, dans une niche à côté d\'une cheminée, dans un couloir qui se resserre, ou autour d\'une porte ou d\'une fenêtre existante. C\'est précisément là que le mobilier standard cale et que la menuiserie commence.',
                'Nous concevons l\'armoire avec vous : ce qu\'elle doit contenir, la façon dont vous l\'utilisez et son rapport au reste de la pièce. Elle est ensuite fabriquée dans notre atelier, puis posée et réglée chez vous.',
            ],
            'highlights' => [
                'Conçue autour de l\'espace réel',
                'Murs en pente, niches et angles',
                'Aménagement intérieur adapté à l\'usage',
                'Fabriquée à l\'atelier, posée par notre équipe',
            ],

            'when' => [
                ['title' => 'Sous une pente de toit', 'text' => 'Un grenier ou une chambre sous rampant est la situation classique où les armoires standard n\'apportent rien et où le sur-mesure gagne immédiatement de la place.'],
                ['title' => 'Dans une niche ou un angle perdu', 'text' => 'Les espaces à côté d\'une cheminée, sous un escalier ou dans un décrochement deviennent utilisables dès que l\'armoire épouse la forme du lieu.'],
                ['title' => 'Lors d\'une rénovation', 'text' => 'Quand la distribution change de toute façon, il est plus simple de concevoir les armoires en même temps que d\'y insérer quelque chose après coup.'],
                ['title' => 'Quand l\'ensemble doit se tenir', 'text' => 'Des armoires dans la même finition que les portes intérieures ou l\'escalier font lire un intérieur comme un tout, et non comme une suite d\'achats.'],
            ],

            'options' => [
                ['title' => 'Aménagement intérieur', 'text' => 'Tablettes, penderies, tiroirs ou une combinaison. Ce que vous y rangez détermine l\'aménagement — et non l\'inverse.'],
                ['title' => 'Portes ou étagères ouvertes', 'text' => 'Entièrement fermée, partiellement ouverte, ou avec des cases ouvertes à hauteur d\'œil. Les parties ouvertes allègent, les parties fermées apaisent la pièce.'],
                ['title' => 'Poignées ou sans poignée', 'text' => 'Une poignée visible ou une exécution sans poignée change considérablement le caractère de l\'armoire, surtout sur une grande surface.'],
                ['title' => 'Raccord à la pièce', 'text' => 'Monter jusqu\'au plafond ou s\'arrêter juste en dessous, avec ou sans plinthe — ces choix décident si l\'armoire se lit comme un meuble ou comme une partie du mur.'],
                ['title' => 'Finition', 'text' => 'Peinte, vernie ou à fil de bois apparent. Nous en discutons sur échantillons, avec le reste de l\'intérieur.'],
            ],

            'werkwijze_intro' => 'Pour une armoire sur mesure, cela se déroule ainsi :',

            'materials' => [
                'Les matériaux et la finition les plus adaptés dépendent du lieu et de l\'usage : une penderie dans une chambre n\'a pas les mêmes exigences qu\'un rangement dans un couloir ou qu\'un encastrement dans une pièce plus humide. Nous passons cela en revue lors de l\'entretien.',
                'Ce que nous ne faisons pas, c\'est imposer un matériau parce qu\'il est le plus simple à travailler pour nous. Si quelque chose n\'est pas une bonne idée dans votre cas, nous le disons.',
            ],

            'faq' => [
                ['q' => 'Pouvez-vous réaliser une armoire sous une pente de toit ?', 'a' => 'Oui, c\'est l\'une des situations où le sur-mesure apporte le plus. Nous relevons la pente, la hauteur et la structure de toiture, et dessinons l\'armoire autour.'],
                ['q' => 'Concevez-vous l\'armoire, ou dois-je venir avec un plan ?', 'a' => 'Les deux sont possibles. Nous partons souvent d\'un croquis ou de photos et élaborons ensemble ce qu\'elle doit contenir et la façon dont vous l\'utilisez.'],
                ['q' => 'Armoires et portes intérieures peuvent-elles avoir la même finition ?', 'a' => 'Oui. Lorsque nous réalisons les deux, nous gardons l\'essence et la finition identiques pour que l\'intérieur se tienne.'],
                ['q' => 'L\'armoire est-elle posée chez moi ou livrée ?', 'a' => 'Nous posons nous-mêmes et réglons sur place. Dans une pièce qui n\'est pas d\'équerre, c\'est justement ce réglage qui décide du résultat.'],
                ['q' => 'Réalisez-vous d\'autres agencements que des armoires ?', 'a' => 'Oui. Le sur-mesure en bois — du mobilier au lambris mural — fait partie de notre travail. N\'hésitez pas à décrire ce que vous avez en tête.'],
                ['q' => 'Combien coûte une armoire sur mesure ?', 'a' => 'Cela dépend trop des dimensions, de l\'aménagement et de la finition pour avancer un prix indicatif. Après un entretien et un relevé, vous recevez un devis qui correspond à votre situation.'],
                ['q' => 'Combien de temps s\'écoule entre l\'entretien et la pose ?', 'a' => 'Cela dépend de l\'ampleur du projet et de ce qui est en cours à l\'atelier. Nous indiquons dans le devis ce qui est réaliste à ce moment-là, pour que vous puissiez y accorder le reste de votre planning.'],
            ],

            'cta_heading' => 'Une armoire qui s\'ajuste exactement ?',
            'cta_text'    => 'Envoyez-nous des photos de la pièce et une description de ce qu\'elle doit contenir. Nous réfléchissons à l\'aménagement avec vous.',
        ],

        /* ── Bardage de façade ──────────────────────────────────────────── */
        'gevelbekleding' => [
            'name'             => 'Bardage de façade',
            'teaser'           => 'Un bardage en bois change le caractère d\'une habitation et achève la façade en dessous.',
            'meta_title'       => 'Bardage de façade en bois sur mesure | Van Kerkhoven',
            'meta_description' => 'Bardage de façade en bois pour rénovation et construction neuve, accordé aux fenêtres, portes et au reste de la façade. Réalisé par Van Kerkhoven.',
            'h1'               => 'Bardage de façade en bois',
            'hero_intro'       => 'Une façade en bois transforme une habitation plus profondément que presque toute autre intervention — et touche d\'emblée à tout ce qu\'elle contient.',
            'service_type'     => 'Bardage de façade en bois',

            'what_heading' => 'Ce que recouvre un bardage en bois',
            'what'         => [
                'Le bardage est une couche de finition en bois qui vient sur la façade existante ou neuve. Il détermine d\'un coup l\'aspect de l\'habitation : les mêmes volumes se lisent tout autrement en brique qu\'en bois posé verticalement.',
                'C\'est en même temps l\'élément le plus lié au reste de la façade. Autour de chaque fenêtre, de chaque porte et de chaque portail, le bardage doit se raccorder proprement, et ce sont ces raccords qui décident finalement si l\'ensemble paraît fini. Il est donc généralement sage d\'examiner bardage et menuiseries extérieures ensemble.',
                'Nous réalisons du bardage en rénovation — où il accompagne souvent le remplacement des fenêtres et des portes — et en construction neuve, où la composition figure déjà dans le projet.',
            ],
            'highlights' => [
                'Raccords aux fenêtres, portes et portails examinés',
                'Rénovation et construction neuve',
                'Vertical, horizontal ou avec une ligne propre',
                'La même équipe que pour vos autres menuiseries extérieures',
            ],

            'when' => [
                ['title' => 'Lors d\'une rénovation de façade', 'text' => 'Si la façade est de toute façon reprise, c\'est le moment : bardage et menuiseries neuves d\'un seul mouvement donnent les raccords soignés difficiles à obtenir après coup.'],
                ['title' => 'Pour une extension', 'text' => 'Une annexe en bois contre une habitation existante en brique rend visible la distinction entre ancien et neuf, au lieu de la masquer.'],
                ['title' => 'Pour une annexe ou un carport', 'text' => 'Une remise, un carport ou un abri de jardin dans le même bardage que la maison fait lire l\'ensemble comme un seul projet.'],
                ['title' => 'Quand la maison paraît trop plate', 'text' => 'Une façade peu mouvementée gagne immédiatement en profondeur et en direction avec une ligne en bois.'],
                ['title' => 'Pour une façade fatiguée', 'text' => 'Le bardage est parfois un moyen de redonner un aspect fini à une façade qui a vieilli. Est-ce la bonne solution chez vous ? Cela dépend de ce qui se trouve dessous ; nous l\'examinons d\'abord.'],
            ],

            'options' => [
                ['title' => 'Sens de la ligne', 'text' => 'Le vertical élance optiquement une façade, l\'horizontal l\'élargit. Sur une grande habitation, c\'est l\'un des choix les plus déterminants.'],
                ['title' => 'Largeur et rythme des lames', 'text' => 'Des lames étroites donnent une image fine et animée ; des lames plus larges une surface plus calme. Nous l\'examinons à l\'échelle de votre façade, pas sur un échantillon de trente centimètres.'],
                ['title' => 'Raccord autour des ouvertures', 'text' => 'Autour des fenêtres, portes et portails, tout se joue. La façon de résoudre ces bords se convient à l\'avance.'],
                ['title' => 'Finition', 'text' => 'Laisser griser naturellement, lasurer ou peindre. Ce n\'est pas un détail : le choix décide autant de l\'image finale que de l\'entretien à venir.'],
                ['title' => 'Combinaison avec d\'autres menuiseries', 'text' => 'Lorsque nous réalisons aussi vos fenêtres, portes ou portail, essence et finition peuvent être identiques.'],
            ],

            'werkwijze_intro' => 'Pour un bardage, un chantier se déroule ainsi :',

            'materials' => [
                'Le choix de l\'essence et de la finition dépend de l\'orientation de la façade, de son degré d\'abri et de l\'image souhaitée. Une façade nord grise autrement qu\'une façade sud, et ce n\'est pas un problème tant que vous le savez d\'avance.',
                'Sur la durée de vie, la vitesse de grisaillement et les intervalles d\'entretien, nous ne donnons pas de chiffres que nous ne pouvons pas garantir. En revanche, nous discutons franchement de ce qu\'un choix implique probablement chez vous — même si cela revient à vous conseiller autre chose.',
            ],

            'faq' => [
                ['q' => 'Un bardage est-il possible sur une façade existante ?', 'a' => 'Souvent oui, mais cela dépend de ce qui se trouve dessous. Lors du relevé, nous examinons la composition existante et les raccords avant de proposer quoi que ce soit.'],
                ['q' => 'Comment se règle le raccord autour des fenêtres et des portes ?', 'a' => 'C\'est la partie la plus importante du travail. Lorsque nous réalisons aussi les menuiseries extérieures, nous pouvons résoudre ces bords d\'emblée plutôt que d\'y adapter quelque chose après coup.'],
                ['q' => 'Un bardage en bois doit-il être traité ?', 'a' => 'C\'est un choix, pas une obligation. Le bois non traité grise ; le bois traité garde sa couleur plus longtemps mais demande un suivi. Nous passons en revue ce qui convient à votre façade.'],
                ['q' => 'Pouvez-vous aussi barder un carport ou une remise ?', 'a' => 'Oui. Les structures en bois et le bardage pour carports, auvents et annexes font partie de notre travail.'],
                ['q' => 'Puis-je barder une seule partie de la façade ?', 'a' => 'Bien sûr. Souvent, un seul pan ou un seul volume est exécuté en bois, précisément pour le mettre en évidence.'],
                ['q' => 'De quoi avez-vous besoin pour établir un prix ?', 'a' => 'Envoyez des photos de la façade et, si vous les avez, les dimensions. Plus l\'image est concrète, plus vite nous pourrons dire ce qui est réalisable.'],
                ['q' => 'Travaillez-vous avec l\'entrepreneur ou l\'architecte ?', 'a' => 'Régulièrement, et pour un bardage c\'est souvent nécessaire : la composition derrière le bois, l\'isolation et les raccords touchent au travail d\'autres corps de métier. Nous prenons cette coordination en charge.'],
            ],

            'cta_heading' => 'Une façade en bois pour votre habitation ?',
            'cta_text'    => 'Envoyez-nous des photos de la façade et une courte description de ce que vous envisagez.',
        ],

    ],

];
