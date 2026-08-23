<?php

return [

    /*
     * Shared labels and the working method — identical for every municipality,
     * so the per-region copy below stays genuinely region-specific.
     */
    'common' => [
        'eyebrow'           => 'Service area',
        'breadcrumb_aria'   => 'Breadcrumb',
        'breadcrumb_home'   => 'Home',
        'back'              => 'Back to home',

        'cta_contact'     => 'Get in touch',
        'cta_realisaties' => 'See our work',

        'services_heading' => 'What we make for :city',
        'service_labels'   => [
            'ramen'       => 'Wooden windows',
            'deuren'      => 'Wooden doors',
            'trappen'     => 'Staircases',
            'poorten'     => 'Gates',
            'schuiframen' => 'Sliding windows',
            'werkplaats'  => 'Our workshop',
        ],
        'service_link' => 'More about :service',

        'lokaal_heading' => 'What working locally actually changes',

        'realisaties_heading' => 'From our work',
        'realisaties_note'    => 'A selection of our joinery. These photos show what we make; they were not necessarily taken in this municipality.',
        'realisatie_alt'      => ':category made to measure by Van Kerkhoven — photo :n of :m',
        'realisaties_link'    => 'See more of our work',

        'faq_heading' => 'Frequently asked questions',

        'other_regions_heading' => 'Other municipalities in our service area',
    ],

    'items' => [

        /* ── Huldenberg ─────────────────────────────────────────────────── */
        'huldenberg' => [
            'name'             => 'Huldenberg',
            'meta_title'       => 'Carpenter in Huldenberg — our workshop | Van Kerkhoven',
            'meta_description' => 'Our workshop is in Huldenberg, on the Hoekstraat. Wooden windows, doors, staircases and gates made to measure, built and fitted by our own people.',
            'h1'               => 'Carpenter in Huldenberg',
            'hero_intro'       => 'Our workshop stands on the Hoekstraat. What we make for homes in Huldenberg is cut, finished and fitted from here.',

            'intro_heading' => 'Our home municipality',
            'intro'         => [
                'Van Kerkhoven has worked from Huldenberg for 45 years. The workshop on the Hoekstraat is not a second branch or an address on paper: this is where the boards arrive, where the machines are and where our installation team\'s vans leave from.',
                'That makes a job in our own municipality straightforward. Scheduling a measuring visit costs little detour, checking a dimension even less, and anyone who wants to see a timber species or a profile in person can drop by after making an appointment rather than receiving a sample in the post.',
                'The housing stock is that of the region itself: older houses and farmsteads in the centres of Neerijse, Sint-Agatha-Rode, Ottenburg and Loonbeek, detached homes on the slopes of the Dijle and IJse valleys, and newer builds in between. Two identical windows on one site are the exception here rather than the rule.',
                'We work for private clients, for renovations and alongside architects — for a single replacement exterior door just as readily as for a house\'s entire exterior joinery.',
            ],
            'highlights' => [
                'Workshop and installation team at Hoekstraat 15–19B',
                'Solid wood, from rough board to finished piece',
                'Samples and profiles viewable on site, by appointment',
                '45 years in the same municipality',
            ],

            'services_intro' => 'Everything below is made in Huldenberg. For your home that means the shortest possible route from workbench to site.',
            'services'       => [
                'ramen'       => 'New exterior joinery or replacement within existing openings. In older Huldenberg houses openings are rarely square, so we measure every window separately rather than working to standard sizes.',
                'deuren'      => 'Front doors, back doors and internal doors in solid wood. In renovation we match the profile to what is already there, so a new door does not read as a foreign element in the façade.',
                'trappen'     => 'Straight staircases, quarter-turn and half-turn. A staircase only goes into production once the real floor-to-floor height and the floor finish are settled.',
                'poorten'     => 'Wooden driveway and garage gates for the detached houses and farmsteads in the municipality, with hardware that stands up to outdoor use.',
                'schuiframen' => 'Sliding windows for anyone who wants to open up a garden elevation without switching to a different material from the rest of the joinery.',
                'werkplaats'  => 'The workshop on the Hoekstraat, where everything above takes shape. You are welcome to come and look, by appointment.',
            ],

            'werkwijze_intro' => 'For a job in our own municipality nothing about the method changes; only the distance is shorter.',

            'lokaal' => [
                'Working locally is not a slogan here but a way of organising. Because the workshop, the installation team and the client are all in the same municipality, nobody needs to sit in between.',
                'Anyone who wants to adjust something during the work discusses it with the people who actually make the piece. If it turns out at installation that a rebate needs to move by a millimetre, that piece goes back to the bench rather than back to a supplier.',
            ],
            'lokaal_points' => [
                'You talk to the carpenter, not to a middleman',
                'Adjustments happen in our own workshop',
                'Installation by our own team',
                'Still reachable after handover',
            ],

            'faq' => [
                [
                    'q' => 'Where exactly is your workshop?',
                    'a' => 'At Hoekstraat 15–19B in Huldenberg. We work by appointment, so let us know in advance if you would like to visit.',
                ],
                [
                    'q' => 'Can I see timber species and finishes in person?',
                    'a' => 'Yes. By appointment you can look at samples, profiles and work in progress in the workshop. That usually makes the choice a good deal easier than it is from a photo.',
                ],
                [
                    'q' => 'Do you take on small jobs too?',
                    'a' => 'Yes. A single internal door, one replacement window or an adapted handrail is just as possible as a full exterior joinery project.',
                ],
                [
                    'q' => 'How do I request a price?',
                    'a' => 'Through the contact form or by e-mail. The more concrete your description — which pieces, which elevation, photos of the existing situation — the sooner we can give you a sensible answer.',
                ],
                [
                    'q' => 'Do you install yourselves or subcontract?',
                    'a' => 'We install with our own team. The same people who know the joinery also fit it.',
                ],
            ],

            'cta_heading' => 'Something in mind for your home in Huldenberg?',
            'cta_text'    => 'Send us your question, preferably with a few photos of the existing situation. We will let you know what is possible.',
        ],

        /* ── Overijse ───────────────────────────────────────────────────── */
        'overijse' => [
            'name'             => 'Overijse',
            'meta_title'       => 'Carpenter in Overijse — wood to measure | Van Kerkhoven',
            'meta_description' => 'Wooden windows, doors and exterior joinery made to measure for homes in Overijse. Built in our workshop in Huldenberg and fitted by our own team.',
            'h1'               => 'Carpenter in Overijse',
            'hero_intro'       => 'From our workshop in Huldenberg we work in Overijse on windows, doors and exterior joinery — often in houses starting their second life.',

            'intro_heading' => 'Overijse and the Druivenstreek',
            'intro'         => [
                'Overijse lies in the same valley as our workshop. The IJse runs through both municipalities and the built fabric is related: distinctly residential, spread across Jezus-Eik, Maleizen, Terlanen and Tombeek, with many detached houses on generous plots.',
                'A large share of that stock dates from the nineteen-sixties to the eighties. That is precisely the generation of houses whose exterior joinery is now due: the layout still works, but windows and doors are worn — and the owner does not want to trade down to a profile that makes the house look cheaper than it is.',
                'On top of that comes the character of the Druivenstreek, a landscape shaped by glass, wood and sloping ground. People renovating here generally take account of what is already there: the façade, the terrace, the view across the valley. Not only of energy performance.',
                'We supply that joinery in solid wood, measured in the existing condition. In renovation that is the difference between work that fits and work that has to be packed out.',
            ],
            'highlights' => [
                'Exterior joinery for renovation and replacement',
                'Measured in the existing openings, not to standard sizes',
                'Solid wood, chosen in consultation',
                'Production and installation in-house',
            ],

            'services_intro' => 'In Overijse the work is usually about the outside of the house. This is what we make for it.',
            'services'       => [
                'ramen'       => 'Replacement of existing exterior joinery in solid wood, with advice on timber species, profile and insulating glazing. Every opening is measured separately.',
                'deuren'      => 'Exterior doors that belong to the façade rather than being added to it — in the same species and finish as the windows if you wish.',
                'trappen'     => 'Internal staircases in solid wood, straight or with a quarter or half turn, fitted to the existing stairwell.',
                'poorten'     => 'Driveway gates and garage doors in wood, for the generous plots that characterise the municipality.',
                'schuiframen' => 'Large sliding windows onto garden or terrace — the most requested piece in renovations with a view over the valley.',
                'werkplaats'  => 'Everything is made in our own workshop in Huldenberg, a short distance away.',
            ],

            'werkwijze_intro' => 'For a house in Overijse a job runs as follows:',

            'lokaal' => [
                'When exterior joinery is replaced, the problems rarely sit in the design and almost always in the connections: a sill that is not level, an opening whose dimensions differ from window to window, an internal finish that has to stay intact.',
                'Because we work close by, we can look at that on site before anything is made — and correct course during installation when the existing condition disappoints. That is exactly why we deliberately work in our own region.',
            ],
            'lokaal_points' => [
                'Measured on site by the people who make it',
                'Corrections in the workshop, not at a supplier',
                'One point of contact from quotation to handover',
                'Reachable for adjustment after installation',
            ],

            'faq' => [
                [
                    'q' => 'Does Van Kerkhoven work in Overijse?',
                    'a' => 'Yes. Overijse is part of our service area; our workshop is in Huldenberg, in the same valley.',
                ],
                [
                    'q' => 'Do you only replace windows, or the whole façade infill?',
                    'a' => 'Both. From a single window to a house\'s entire exterior joinery, including doors, sliding windows and gates.',
                ],
                [
                    'q' => 'Do you work to standard sizes or is everything measured?',
                    'a' => 'Everything is measured. We take each opening separately; in renovation there are hardly ever two the same.',
                ],
                [
                    'q' => 'Can I send my own photos or ideas?',
                    'a' => 'Please do. Photos of the existing façade and of what appeals to you say more than a description and often set the direction of the proposal straight away.',
                ],
                [
                    'q' => 'How far in advance should I get in touch?',
                    'a' => 'That depends on the size of the job and on what is in production at the time. Feel free to contact us early; then you know where you stand.',
                ],
            ],

            'cta_heading' => 'Exterior joinery for your home in Overijse?',
            'cta_text'    => 'Send us photos of the existing façade and a short description. We will look at what is possible.',
        ],

        /* ── Hoeilaart ──────────────────────────────────────────────────── */
        'hoeilaart' => [
            'name'             => 'Hoeilaart',
            'meta_title'       => 'Carpenter in Hoeilaart — renovation | Van Kerkhoven',
            'meta_description' => 'Made-to-measure solid wood for Hoeilaart: windows, sliding windows, doors and staircases. Renovation where new joinery sits well with what is already there.',
            'h1'               => 'Carpenter in Hoeilaart',
            'hero_intro'       => 'Contemporary joinery that suits an existing house — in Hoeilaart that is usually the brief.',

            'intro_heading' => 'Renovating between forest and Druivenstreek',
            'intro'         => [
                'Hoeilaart is compactly built and sits against the Sonian Forest. That gives the municipality a housing stock of its own: a dense centre of interwar houses and town houses, and around it villas that, given the nearby woodland, often turn a lot of glass towards the garden.',
                'Renovating here almost always means working within an existing architecture. Replacing a window in a nineteen-thirties façade is a different exercise from fitting one in a new build: the division, the glazing bars and the depth of the profile all help decide whether the façade still reads correctly once the work is done.',
                'At the same time, almost nobody wants a literal copy of what was there. The request is usually this: contemporary execution, contemporary comfort, but with a profile that does not upset the façade. That calls for decisions made up front, from dimensions and samples, rather than improvised on site.',
                'As a joinery with its own workshop, we can also carry those decisions out. A profile that appears in no catalogue is, for us, a drawing and a machine setting — not an exception to be substituted with something else.',
            ],
            'highlights' => [
                'New joinery matched to existing façades',
                'Profiles and divisions to measure, not from a catalogue',
                'Solid wood for interior and exterior work',
                'Workshop in Huldenberg, in the same region',
            ],

            'services_intro' => 'What we make for homes in Hoeilaart:',
            'services'       => [
                'ramen'       => 'Renovation windows that take the existing division and the look of the façade as their starting point, executed with current glazing and hardware.',
                'deuren'      => 'Exterior and internal doors in solid wood, from a classic panelled model to a flat, clean door leaf.',
                'trappen'     => 'Staircases for existing stairwells, where the available space rather than a standard size determines the form.',
                'poorten'     => 'Wooden gates for driveways and outbuildings, in the same species and finish as the rest of the exterior joinery.',
                'schuiframen' => 'Sliding windows onto garden or terrace — much requested in houses oriented towards the greenery.',
                'werkplaats'  => 'Our workshop, where profiles and joints are actually made.',
            ],

            'werkwijze_intro' => 'From first question to finished joinery it runs like this:',

            'lokaal' => [
                'Renovation work is decided before production starts. Anyone who knows façades knows that an opening measured at three heights gives three different dimensions, and that a sill is rarely plumb.',
                'Direct consultation solves that. You discuss your plans with the people who also make and fit the joinery, so a choice about profile or finish is immediately tested against what is technically achievable.',
                'For the client that mainly means little has to be repeated along the way. What was agreed at the measuring visit sits on the workbench, not in an order form that has passed through three sets of hands.',
            ],
            'lokaal_points' => [
                'Direct consultation on profile and division',
                'Measured in the existing condition',
                'Our own production, so adjustments stay possible',
                'Follow-up after installation',
            ],

            'faq' => [
                [
                    'q' => 'Do you work in Hoeilaart?',
                    'a' => 'Yes. Hoeilaart is part of our service area; we work from our workshop in Huldenberg.',
                ],
                [
                    'q' => 'Can new joinery sit well with an older façade?',
                    'a' => 'That is often exactly the brief. We start from the existing division and profile depth and work them out in a contemporary execution.',
                ],
                [
                    'q' => 'Can a renovation be done in phases?',
                    'a' => 'Yes. For example the street elevation first and the garden elevation later, in the same species and finish, so the whole still reads as one.',
                ],
                [
                    'q' => 'How does measuring work?',
                    'a' => 'We come on site, measure every opening separately and look at the connections: sills, internal finishes, insulation. Only then does anything go into production.',
                ],
                [
                    'q' => 'Do you work with architects?',
                    'a' => 'Regularly. Where an architect is involved, we settle the details directly with them.',
                ],
                [
                    'q' => 'Do you make the interior joinery in a renovation as well?',
                    'a' => 'Yes. Internal doors, staircases and bespoke work in solid wood belong to the same trade and are often taken on alongside the exterior joinery.',
                ],
            ],

            'cta_heading' => 'A renovation planned in Hoeilaart?',
            'cta_text'    => 'Tell us what is there and what you want to achieve. We will think the execution through with you.',
        ],

        /* ── Tervuren ───────────────────────────────────────────────────── */
        'tervuren' => [
            'name'             => 'Tervuren',
            'meta_title'       => 'Carpenter in Tervuren — made to measure | Van Kerkhoven',
            'meta_description' => 'Joinery made to measure for Tervuren, Duisburg, Vossem and Moorsel: windows, doors, staircases and gates in solid wood, with a careful finish.',
            'h1'               => 'Carpenter in Tervuren',
            'hero_intro'       => 'From classic town houses to contemporary new builds — in Tervuren it is usually the finish that makes the difference.',

            'intro_heading' => 'Classic and contemporary side by side',
            'intro'         => [
                'Tervuren has a housing stock with two faces. Around the park and the old avenues stand generous, classically conceived houses; in Duisburg, Vossem and Moorsel and in the more recent developments the work is more often contemporary architecture, with larger glazed areas and cleaner profiles.',
                'Both ask the same thing of a joiner: that the work holds up down to the detail. On a classic profile you see immediately if a joint is not clean; on a flat door leaf you see every deviation in flatness and in joint width.',
                'That is why we work in solid wood and make every piece in our own workshop. Choosing a species is therefore not an order from a catalogue but a conversation about use, the orientation of the façade, and maintenance.',
                'We work both directly for clients and alongside architects, on new builds as well as on the renovation of existing joinery.',
            ],
            'highlights' => [
                'Classic and contemporary profiles',
                'Careful finish, including on visible joints',
                'Advice on species per application',
                'New build and renovation',
            ],

            'services_intro' => 'What we make in Tervuren and its villages:',
            'services'       => [
                'ramen'       => 'Windows in solid wood, from fine classic glazing-bar divisions to large fixed lights with a minimal visible profile.',
                'deuren'      => 'Front doors that serve as the house\'s calling card, and internal doors running to ceiling height where the design asks for it.',
                'trappen'     => 'Staircases as a visible part of the interior — solid, with carefully worked treads and handrails.',
                'poorten'     => 'Wooden driveway gates for larger plots, with hardware sized for the weight.',
                'schuiframen' => 'Sliding windows connecting garden and living space, with running gear that stays smooth years on.',
                'werkplaats'  => 'Our workshop, where the level of finish is decided.',
            ],

            'werkwijze_intro' => 'A job in Tervuren goes through the same steps as anywhere else:',

            'lokaal' => [
                'On finish-driven work, the distance between drawing and execution is the biggest risk. The more links in between, the more is lost between what was discussed and what eventually hangs there.',
                'We keep that path short: the same joinery measures, makes and installs. Anyone who wants to look at a detail during the work speaks to the people who made it.',
                'In practice that also means one team on site. If you notice something during installation that could be better, it does not have to go through a third party who then has to pass it on to the maker.',
            ],
            'lokaal_points' => [
                'From measuring to installation, all in-house',
                'Details discussed directly',
                'Collaboration with architects possible',
                'Workshop a short distance away',
            ],

            'faq' => [
                [
                    'q' => 'Do you also come to Duisburg, Vossem and Moorsel?',
                    'a' => 'Yes. The whole municipality of Tervuren is part of our service area, its villages included. Our workshop is in Huldenberg, a short distance away.',
                ],
                [
                    'q' => 'Do you make both classic and contemporary joinery?',
                    'a' => 'Both. We work in solid wood and machine the profiles ourselves, so a classic glazing-bar division is possible and so is a flat, clean door leaf.',
                ],
                [
                    'q' => 'Which timber species do you recommend?',
                    'a' => 'That depends on interior or exterior use, on the orientation of the façade and on how much maintenance you want. We go through the options before anything is fixed.',
                ],
                [
                    'q' => 'Can you work with our architect?',
                    'a' => 'Yes. On projects with an architect we settle dimensions, details and finish directly with them.',
                ],
                [
                    'q' => 'Do you also supply without installation?',
                    'a' => 'We usually install ourselves, because that keeps us responsible for the end result. Do let us know what you have in mind.',
                ],
                [
                    'q' => 'How long does a job take from start to installation?',
                    'a' => 'That varies too much from job to job to put a fixed number on it: a single door is a different matter from a house\'s entire joinery package. We indicate what is realistic at the time in the quotation.',
                ],
            ],

            'cta_heading' => 'A project in Tervuren?',
            'cta_text'    => 'Describe briefly what you are after — new build or renovation, a single piece or the full joinery package. We will get back to you.',
        ],

        /* ── Bertem ─────────────────────────────────────────────────────── */
        'bertem' => [
            'name'             => 'Bertem',
            'meta_title'       => 'Carpenter in Bertem — solid wood | Van Kerkhoven',
            'meta_description' => 'Joinery made to measure for Bertem, Leefdaal and Korbeek-Dijle: windows, doors, gates and timber structures in solid wood, fitted by our own team.',
            'h1'               => 'Carpenter in Bertem',
            'hero_intro'       => 'In Bertem, Leefdaal and Korbeek-Dijle the work is often about wood that stands outdoors: gates, cladding and robust exterior joinery.',

            'intro_heading' => 'Building rural, maintaining rural',
            'intro'         => [
                'Bertem, Leefdaal and Korbeek-Dijle sit out in open country. Ribbon development along the main roads, older farmsteads with their outbuildings, and residential houses with plenty of outdoor space in between — it gives the municipality a particular kind of joinery demand.',
                'Wood standing outdoors in that setting takes more punishment than wood in a sheltered street. Wind across open fields, driving rain, sun without the shade of neighbouring buildings: all of it weighs on the choice of species, of finish, and of how a structure is built up.',
                'We take that into account. A gate in an open driveway is built differently from a gate between two walls, and south-facing cladding asks for a different maintenance rhythm than north-facing cladding. We say so beforehand, not afterwards.',
                'Besides exterior work we of course also make the interior work: staircases, internal doors and bespoke pieces, in the same solid wood.',
            ],
            'highlights' => [
                'Exterior joinery built for an exposed setting',
                'Gates, cladding and timber structures',
                'Straight advice on species and maintenance',
                'Internal doors, staircases and bespoke work too',
            ],

            'services_intro' => 'What we make for the houses and farmsteads in the municipality:',
            'services'       => [
                'ramen'       => 'Wooden windows for new build and renovation, with a profile and species choice suited to an exposed setting.',
                'deuren'      => 'Robust exterior doors and internal doors in solid wood, with hardware that takes daily use.',
                'trappen'     => 'Solid staircases for houses and converted farmsteads, measured in the actual situation.',
                'poorten'     => 'Driveway and garage gates in wood — in this setting the most requested piece of exterior joinery.',
                'schuiframen' => 'Sliding windows onto garden or terrace, in the same species as the rest of the exterior joinery.',
                'werkplaats'  => 'Our workshop in Huldenberg, where structures are assembled and finished.',
            ],

            'werkwijze_intro' => 'This is how a job in Bertem, Leefdaal or Korbeek-Dijle runs:',

            'lokaal' => [
                'Anyone building or converting in the countryside knows a site rarely keeps to the plan. A delivery that slips, a contractor finishing early, weather that holds up installation.',
                'Because we work in the same region we can absorb that reasonably flexibly. And because we install ourselves, nobody can point at someone else when something needs adjusting afterwards.',
                'On top of that, exterior joinery here is often tackled in phases: the gate first, the windows later, the cladding later still. Because we made the earlier work ourselves, we know which species and finish were chosen at the time.',
            ],
            'lokaal_points' => [
                'Short lines to the site',
                'Our own installation team',
                'Maintenance advice before the choice is fixed',
                'Reachable after handover',
            ],

            'faq' => [
                [
                    'q' => 'Do you work in Leefdaal and Korbeek-Dijle too?',
                    'a' => 'Yes, just as in Bertem itself. The whole municipality is part of our service area.',
                ],
                [
                    'q' => 'Which species lasts longest outdoors?',
                    'a' => 'No single answer holds for every situation. Position, orientation and the finish you choose weigh as heavily as the species itself. We go through the options based on your situation.',
                ],
                [
                    'q' => 'Do you also make gates for an existing driveway?',
                    'a' => 'Yes. We measure the existing opening and the fixing points and build the gate around them, hardware included.',
                ],
                [
                    'q' => 'Do you renovate existing joinery as well?',
                    'a' => 'Yes. Sometimes repair makes sense, sometimes replacement does. We say honestly which we think is the better choice.',
                ],
                [
                    'q' => 'Can I request a quotation?',
                    'a' => 'Certainly. Send your question through the contact form, preferably with dimensions or photos. We will tell you what we need in order to price it.',
                ],
                [
                    'q' => 'Do you make joinery for an outbuilding or carport too?',
                    'a' => 'Yes. Timber structures for carports, canopies and outbuildings are part of our work, as is wooden cladding.',
                ],
            ],

            'cta_heading' => 'Joinery needed in Bertem?',
            'cta_text'    => 'Tell us what has to be made and where it is. We will look at the situation and come out if needed.',
        ],

        /* ── Leuven ─────────────────────────────────────────────────────── */
        'leuven' => [
            'name'             => 'Leuven',
            'meta_title'       => 'Carpenter in Leuven — windows and doors | Van Kerkhoven',
            'meta_description' => 'Windows, doors and staircases made to measure for Leuven, Kessel-Lo, Heverlee, Wilsele and Wijgmaal. Built in our own workshop and fitted by us.',
            'h1'               => 'Carpenter in Leuven',
            'hero_intro'       => 'Renovating a town house takes bespoke work and planning alike. We make the joinery ourselves and we fit it ourselves.',

            'intro_heading' => 'Renovating in a city',
            'intro'         => [
                'Leuven is more densely built than the rest of our service area. Terraced houses in the centre, town houses along the approach roads, and in Kessel-Lo, Heverlee, Wilsele and Wijgmaal residential districts of widely varying ages.',
                'What makes joinery in the city different is rarely the piece itself and almost always the circumstances around it. A façade right on the pavement, a staircase that has to go up through a narrow hallway, a street where loading and unloading costs time. All of it can be planned — but only if you know about it in advance.',
                'So when we measure in the city we look not only at dimensions but also at the way in. A staircase that fits perfectly but will not go down the hallway is not a staircase.',
                'For the rest nothing changes: solid wood, made in our own workshop, fitted by our own team.',
            ],
            'highlights' => [
                'Used to narrow hallways and restricted access',
                'Windows, doors and staircases for terraced houses',
                'Measuring that includes the route in',
                'Installation by our own team',
            ],

            'services_intro' => 'What we make for homes in Leuven:',
            'services'       => [
                'ramen'       => 'Windows for terraced and town houses, taking the existing façade division as the starting point. Where the façade helps shape the streetscape, settle that in advance with your architect or with the municipality; we supply the joinery that follows from it.',
                'deuren'      => 'Front doors for terraced houses, and internal doors for reconfigurations where existing frames are kept or removed.',
                'trappen'     => 'Staircases made to measure for narrow stairwells — including the question of whether the piece gets in as one or has to be assembled in parts.',
                'poorten'     => 'Wooden gates for yards, garages and side passages.',
                'schuiframen' => 'Sliding windows onto a city garden or courtyard, where every centimetre of opening counts.',
                'werkplaats'  => 'Our workshop in Huldenberg, a short distance from the city.',
            ],

            'werkwijze_intro' => 'For a house in Leuven the process looks like this:',

            'lokaal' => [
                'In city renovations, follow-up counts for more than in new build. You usually live there during the work, space is tight and there are neighbours.',
                'So we plan installation in consultation and work with our own team, so that one party stays responsible for what happens on site — and for whatever still needs adjusting afterwards.',
                'It helps in the preparation too. When the site, the production and the installation all sit with the same party, a delivery date can shift without three separate diaries having to be realigned.',
            ],
            'lokaal_points' => [
                'Installation scheduled in consultation',
                'One responsible team on site',
                'Access and neighbours taken into account',
                'Reachable for aftercare',
            ],

            'faq' => [
                [
                    'q' => 'Do you work in the centre of Leuven?',
                    'a' => 'Yes, and in Kessel-Lo, Heverlee, Wilsele and Wijgmaal as well. Our workshop is in Huldenberg, a short distance away.',
                ],
                [
                    'q' => 'Can a made-to-measure staircase fit a narrow stairwell?',
                    'a' => 'Usually yes, but the dimensions decide. When measuring we also check whether the piece gets in as one or has to be assembled in parts.',
                ],
                [
                    'q' => 'How does installation work if the street is hard to reach?',
                    'a' => 'We discuss that while measuring and plan the installation around it. What is known in advance costs no time later.',
                ],
                [
                    'q' => 'Do you do renovations as well?',
                    'a' => 'A large part of our work is renovation: replacing existing joinery, adapting it during a reconfiguration, or new work in an existing house.',
                ],
                [
                    'q' => 'Can I send my own ideas or photos?',
                    'a' => 'Yes. Photos of the existing situation and of what you have in mind help us answer concretely straight away.',
                ],
                [
                    'q' => 'Can the joinery be fitted while we keep living in the house?',
                    'a' => 'In city renovations that is the rule rather than the exception. We adapt the schedule accordingly and work elevation by elevation or floor by floor, so the house stays liveable.',
                ],
            ],

            'cta_heading' => 'A renovation or bespoke work in Leuven?',
            'cta_text'    => 'Send us photos of the situation and a short description. We will let you know what we suggest.',
        ],

    ],

];
