<?php

return [

    /*
     * Shared labels. The working method itself lives in lang/en/werkwijze.php,
     * so region pages and service pages show exactly the same steps.
     */
    'common' => [
        'eyebrow'         => 'Service',
        'breadcrumb_aria' => 'Breadcrumb',
        'breadcrumb_home' => 'Home',

        'cta_contact'   => 'Request a price',
        'cta_secondary' => 'More about :service',

        'when_heading'      => 'When is this worth considering?',
        'options_heading'   => 'Options and choices',
        'materials_heading' => 'Materials and finish',

        'realisaties_heading' => 'From our work',
        'realisaties_note'    => 'Photos from earlier jobs. They show our work in general; not every photo is an example of this exact execution.',
        'realisatie_alt'      => 'Joinery by Van Kerkhoven — photo :n of :m',

        'faq_heading' => 'Frequently asked questions',

        'related_heading' => 'Related services',
        'related_link'    => 'Go to :service',

        // Compact block at the foot of the existing main service pages
        'subservices_heading' => 'In more detail',
        'subservices_intro'   => 'Separate pages on parts of this service.',
        'subservices_link'    => 'Read on',
    ],

    'items' => [

        /* ── Interior doors ─────────────────────────────────────────────── */
        'binnendeuren' => [
            'name'             => 'Interior doors',
            'teaser'           => 'Doors that help shape the layout and the feel of your interior — made to fit existing or new frames.',
            'meta_title'       => 'Interior doors made to measure in wood | Van Kerkhoven',
            'meta_description' => 'Interior doors made to measure in solid wood, matched to your frames, floors and interior. Built in our own workshop in Huldenberg and fitted by us.',
            'h1'               => 'Interior doors made to measure',
            'hero_intro'       => 'An interior door helps decide how a room feels. We make them to fit the frames that are there — or the frames still to come.',
            'service_type'     => 'Made-to-measure interior doors',

            'what_heading' => 'What a made-to-measure interior door involves',
            'what'         => [
                'A made-to-measure interior door is more than a leaf in a different width. It is the leaf, the frame, the rebate, the hardware and the way the whole thing meets the floor and the wall. Together those parts decide whether a door closes well — and whether it still will in ten years.',
                'Here that whole is made in our own workshop. We start from the real opening: a masonry reveal is rarely the same width all the way up, floor levels differ from room to room, and in renovation an existing frame is often no longer quite plumb. Anyone approaching that with standard sizes ends up packing out the difference afterwards.',
                'We make single and double doors, with or without glass, and with the frame you choose: a classic architrave, a slim casing, or a joint that disappears into the plaster. A door running to ceiling height is technically an ordinary job too — it simply takes more preparation.',
            ],
            'highlights' => [
                'Leaf, frame, rebate and hardware as one whole',
                'Measured in the existing opening',
                'Single or double, with or without glass',
                'Made and fitted by our own people',
            ],

            'when' => [
                ['title' => 'In a renovation', 'text' => 'The frames stay, but the doors are worn or no longer suit the new finish. We measure each frame separately and make leaves that fall into the existing rebate.'],
                ['title' => 'In a reconfiguration', 'text' => 'A wall goes, a room is split, a doorway moves. Frame and door then both come new, matched to the new floor finish.'],
                ['title' => 'In new build', 'text' => 'The dimensions are fixed on the drawing, the execution is not. Height, frame profile and finish are discussed before the doors go into production.'],
                ['title' => 'For a single replacement door', 'text' => 'One door is fine too. We then look for a profile that matches the doors that are staying, so the new one does not stand out as a foreign element.'],
            ],

            'options' => [
                ['title' => 'Flat or panelled', 'text' => 'A flat leaf suits a clean interior; a panelled door suits older houses and existing doors that are staying. We make both in solid wood.'],
                ['title' => 'Height and proportion', 'text' => 'A standard height is a habit, not an obligation. A door running to ceiling height noticeably changes the proportions of a hallway or living room.'],
                ['title' => 'Frame and architrave', 'text' => 'A visible architrave, a slim casing or a flush joint — the choice decides how emphatically the door sits in the wall.'],
                ['title' => 'Glazed or solid', 'text' => 'Glass brings light into a hallway with no window. In that case we discuss the division of the glazed area and the width of the surrounding parts up front.'],
                ['title' => 'Hand of the door and hardware', 'text' => 'Which way the door swings decides how a room is used. You choose the hardware with us; we make sure the rebate and hinges are sized for the weight of the leaf.'],
                ['title' => 'Finish', 'text' => 'Oiled, lacquered or painted. What suits best depends on the rest of the interior and on how much maintenance you want. We go through the options on samples.'],
            ],

            'werkwijze_intro' => 'For interior doors the process looks like this:',

            'materials' => [
                'We work in solid wood. Which species suits depends on the look you are after, on the finish going on it and on how heavy the leaf may become. A door running to the ceiling is simply a different matter from a narrow store-room door.',
                'The finish we discuss on samples, not on a photo. Colour and sheen look different in person than on a screen — especially with wood, where the grain carries through into the end result.',
            ],

            'faq' => [
                ['q' => 'Can you make doors for existing frames?', 'a' => 'Yes, that is a large part of the work. We measure the frame and make the leaf to it. Where a frame is no longer square, we allow for that in the dimensions.'],
                ['q' => 'Do you make the frames as well?', 'a' => 'Yes. In new build or a reconfiguration we supply frame and door as one whole, so the rebate and the finish are matched.'],
                ['q' => 'Can I have a single door made?', 'a' => 'You can. We take on small jobs the same way as large ones; only the lead time depends on what is in production at that moment.'],
                ['q' => 'What about the clearance above the floor?', 'a' => 'We only settle that once the floor finish is fixed. Otherwise the gap at the bottom is wrong, or the door catches on a carpet or a threshold.'],
                ['q' => 'Do you supply the hardware too?', 'a' => 'We discuss the hardware with you, so hinges and lock match the weight and the use of the door. Anything you supply yourself we can of course fit.'],
                ['q' => 'How long before the doors are fitted?', 'a' => 'That depends on the number of doors and on the workshop schedule. We state what is realistic at the time in the quotation; we would rather name a workable lead time than a short one.'],
            ],

            'cta_heading' => 'Interior doors for your home?',
            'cta_text'    => 'Send us the dimensions or photos of the existing frames. We will let you know what is possible and what it involves.',
        ],

        /* ── Exterior doors ─────────────────────────────────────────────── */
        'buitendeuren' => [
            'name'             => 'Exterior doors',
            'teaser'           => 'The front door is the first thing a visitor sees — and the part that takes the most punishment.',
            'meta_title'       => 'Exterior doors made to measure in wood | Van Kerkhoven',
            'meta_description' => 'Front and back doors made to measure in solid wood, matched to your façade and the rest of the exterior joinery. Built and fitted by Van Kerkhoven.',
            'h1'               => 'Exterior doors made to measure',
            'hero_intro'       => 'An exterior door has to look right and work every day, for years, in all weathers. We make them to fit your façade.',
            'service_type'     => 'Made-to-measure exterior doors',

            'what_heading' => 'What a made-to-measure exterior door involves',
            'what'         => [
                'An exterior door sits on the line between inside and outside and takes everything that comes with that: rain, sun, temperature swings and daily use. The demands differ from an interior door. How the leaf is built up, how it meets the sill and how water is led away weigh more heavily here than the styling.',
                'At the same time it is the part visitors look at first. A front door that does not suit the façade is noticed immediately — and one that does suit it is not noticed at all. So we start from the façade: the existing opening, the surrounding materials and the joinery already in it.',
                'We make front doors, back doors and store-room doors, with or without a sidelight or fanlight. In renovation we measure the existing opening; in new build we agree the dimensions with the contractor or architect, preferably before the masonry is finished.',
            ],
            'highlights' => [
                'Front doors, back doors and store-room doors',
                'Matched to the façade and the rest of the exterior joinery',
                'Sill connection and water run-off taken into account',
                'Fitted by our own team',
            ],

            'when' => [
                ['title' => 'As a replacement', 'text' => 'The existing door closes badly, has warped, or no longer suits a renewed façade. We measure the opening and build the new door around it.'],
                ['title' => 'During a façade renovation', 'text' => 'When windows and doors are replaced together, profile, species and finish can be matched. That gives a far calmer façade than replacing piece by piece.'],
                ['title' => 'In new build', 'text' => 'The opening is fixed on the drawing, the execution is not. The earlier we look in, the simpler the connections are to make later.'],
                ['title' => 'For an outbuilding or store', 'text' => 'A door to a garage, garden room or store can be in the same species and finish as the rest, so the whole stays one thing.'],
            ],

            'options' => [
                ['title' => 'Solid or glazed', 'text' => 'A solid leaf gives privacy, glass brings light into the hallway. It often becomes a combination: a solid lower part with a glazed area or a fanlight above.'],
                ['title' => 'Classic or clean', 'text' => 'A moulded panelled door belongs with older façades; a flat leaf with a vertical handle with contemporary architecture. We machine the profiles ourselves, so you are not tied to a catalogue.'],
                ['title' => 'Sidelight and fanlight', 'text' => 'Where the opening is wider or taller than a door leaf, the whole gets divided. How that division runs strongly determines the look of the façade.'],
                ['title' => 'Hardware and locking', 'text' => 'Handles, hinges and locking are chosen with you. We match them to the weight of the leaf and to how heavily the door is used.'],
                ['title' => 'Finish', 'text' => 'Exterior joinery needs a finish that stands up to sun and rain. What makes sense in your case depends on the orientation of the façade and on how much maintenance you want to do — we discuss that straight.'],
            ],

            'werkwijze_intro' => 'For an exterior door a job runs as follows:',

            'materials' => [
                'We work in solid wood. The species is chosen in consultation, based on where the door sits, how sheltered it is and the finish going on it. A south-facing door with no canopy simply calls for different arrangements than a door in a sheltered porch.',
                'We make no paper promises about lifespan and maintenance intervals. What we do is say beforehand what a given choice means in practice, so you are not caught out later.',
            ],

            'faq' => [
                ['q' => 'Can you replace an existing front door without altering the façade?', 'a' => 'Usually yes. We measure the existing opening and the fixing points and build the new door around them. Only where the masonry or the sill is no longer sound does more come into it; we say so when measuring.'],
                ['q' => 'Can the door and windows be in the same style?', 'a' => 'Yes, and that is generally the advice. Where we carry out the full exterior joinery, we keep profile, species and finish the same.'],
                ['q' => 'Do you make doors with a sidelight or fanlight?', 'a' => 'Yes. For wider or taller openings we divide the whole; that division is discussed up front, because it strongly determines the look of the façade.'],
                ['q' => 'What about the security of the door?', 'a' => 'Locking and hardware are discussed with you. Which solution makes sense depends on the situation; we do not quote resistance classes we cannot stand behind.'],
                ['q' => 'How much maintenance does a wooden exterior door need?', 'a' => 'That depends on the finish and on how exposed the door is. At the discussion we say what you can realistically expect in your situation.'],
                ['q' => 'Do you fit the door yourselves?', 'a' => 'Yes, with our own installation team. That keeps one party responsible for the leaf, the frame and the connections.'],
            ],

            'cta_heading' => 'A new exterior door for your home?',
            'cta_text'    => 'Send us a photo of the existing façade and opening. We will let you know what is possible.',
        ],

        /* ── Wooden windows ─────────────────────────────────────────────── */
        'houten-ramen' => [
            'name'             => 'Wooden windows',
            'teaser'           => 'Windows in solid wood, measured in the existing opening and matched to the architecture of the house.',
            'meta_title'       => 'Wooden windows made to measure in solid wood | Van Kerkhoven',
            'meta_description' => 'Wooden windows made to measure for renovation and new build. Profile, division and finish matched to your façade, built in our workshop in Huldenberg.',
            'h1'               => 'Wooden windows made to measure',
            'hero_intro'       => 'Wood gives a façade something other materials struggle to reach: a profile with depth and a grain that moves with the light.',
            'service_type'     => 'Made-to-measure wooden windows',

            'what_heading' => 'What made-to-measure wooden windows involve',
            'what'         => [
                'A made-to-measure window starts at the opening, not at a catalogue. We measure every opening separately — in renovation at several heights, because a masonry reveal is rarely dead straight. From those dimensions we draw the division, the profile and the connections.',
                'The window is then made in our own workshop: the timber is planed, the profiles machined, the joints made and the whole finished. Because a profile here is a machine setting rather than a product code, the window can take the shape the façade asks for instead of the other way round.',
                'We work both on renovations — where the existing look of the façade is the starting point — and on new build, where the dimensions can still be agreed with the contractor or architect.',
            ],
            'highlights' => [
                'Every opening measured separately',
                'Profile and division to measure, not from a catalogue',
                'Renovation and new build',
                'Our own workshop and our own installation team',
            ],

            'when' => [
                ['title' => 'Renovating an older house', 'text' => 'The existing windows are worn, but the façade still has to read correctly. We take the existing division and profile depth as the starting point and work them out in a contemporary execution.'],
                ['title' => 'Where the streetscape counts', 'text' => 'In a street where the façades together make the picture, the division of the window weighs more than the material. Wood allows fine divisions without the profile becoming heavy.'],
                ['title' => 'In new build, for warmth', 'text' => 'Wood is often chosen in new build too — precisely because on the inside it gives something other than a flat, cool profile.'],
                ['title' => 'When replacing in phases', 'text' => 'The street elevation first, the garden elevation later. Because we made the earlier work ourselves, we know which profile and finish were chosen then.'],
            ],

            'options' => [
                ['title' => 'Division and layout', 'text' => 'Fixed lights, opening lights, tilt-and-turn, a division with glazing bars. Your choice determines the look as much as the convenience; we draw it out before anything is made.'],
                ['title' => 'Profile depth', 'text' => 'A fine profile lightens the façade, a heavier profile suits older houses better. Here that is a choice, not a limit of the system.'],
                ['title' => 'Glazing', 'text' => 'Which glazing suits your situation we discuss on the basis of what is there and what you want to achieve. We do not put performance figures on a project we have not yet seen.'],
                ['title' => 'Finish', 'text' => 'Painted, lacquered or finished transparently, leaving the grain visible. The choice goes together with the look you want and with maintenance.'],
                ['title' => 'Connections', 'text' => 'Sills, internal finishes and insulation are part of the window. When measuring we look at the complete connection, not just the frame.'],
            ],

            'werkwijze_intro' => 'For wooden windows it runs like this:',

            'materials' => [
                'We work in solid wood. Which species suits depends on the orientation of the façade, on the finish you want and on how much maintenance you are willing to do. No species is the best choice in every situation, and we do not pretend otherwise.',
                'Samples and profile sections can be seen in the workshop by appointment. In person, a species and a colour are a good deal easier to choose than on a screen.',
            ],

            'faq' => [
                ['q' => 'Do you work to standard sizes?', 'a' => 'No. Every opening is measured separately. In renovation there are hardly ever two the same, and even in new build the execution often departs from the drawing.'],
                ['q' => 'Can a new window sit well with an older façade?', 'a' => 'That is often exactly the brief. We start from the existing division and profile depth and execute them with current glazing and hardware.'],
                ['q' => 'Do you replace a single window as well?', 'a' => 'Yes. We do take account of the windows that are staying, so the new one does not stand out as a foreign element in the façade.'],
                ['q' => 'Do you handle the internal finishing too?', 'a' => 'When measuring we look at the complete connection: sill, insulation and internal finish. Exactly what we take on is agreed in advance, so no gaps appear in the schedule.'],
                ['q' => 'What is the difference with aluminium windows?', 'a' => 'In short: wood gives more freedom in the profile and a warmer look, aluminium a cleaner and slimmer one. Which material suits depends on the architecture and on the maintenance you want.'],
                ['q' => 'Can I see a sample of the species and finish?', 'a' => 'Yes, by appointment at the workshop in Huldenberg. Do bring a colour sample or a photo of your façade — side by side it is immediately clear what works.'],
            ],

            'cta_heading' => 'Wooden windows for your home?',
            'cta_text'    => 'Send us photos of the existing façade and a short description. We will look at what is possible.',
        ],

        /* ── Aluminium windows ──────────────────────────────────────────── */
        'aluminium-ramen' => [
            'name'             => 'Aluminium windows',
            'teaser'           => 'A slim, clean profile for anyone after a contemporary façade and large areas of glass.',
            'meta_title'       => 'Aluminium windows made to measure | Van Kerkhoven',
            'meta_description' => 'Aluminium windows made to measure for contemporary architecture and large glazed areas. Measured, discussed and fitted by Van Kerkhoven of Huldenberg.',
            'h1'               => 'Aluminium windows made to measure',
            'hero_intro'       => 'Where a façade calls for a slim profile and a large area of glass, aluminium is often the logical choice.',
            'service_type'     => 'Made-to-measure aluminium windows',

            'what_heading' => 'What made-to-measure aluminium windows involve',
            'what'         => [
                'Van Kerkhoven is first and foremost a joinery: most of what we make is solid wood from our own workshop. Not every project calls for wood, though. Where a façade asks for a pronouncedly slim profile or a very large glazed area, aluminium is usually the better answer.',
                'The approach does not change. We start from the opening and from what you want to achieve, not from a product list. We measure on site, discuss the division and the way it opens, and make sure the connection to the façade and to the internal finish is right.',
                'It is often a combination: wood where the look and the warmth count, aluminium where the profile has to stay as slim as possible. That is no problem, as long as the choice is made deliberately and does not come out differently on every elevation.',
            ],
            'highlights' => [
                'For contemporary architecture and large glazed areas',
                'Measured in the existing situation',
                'Also in combination with wooden joinery',
                'One point of contact from discussion to installation',
            ],

            'when' => [
                ['title' => 'In a contemporary new build', 'text' => 'Where the design is based on a minimal visible profile and large, continuous areas of glass.'],
                ['title' => 'For an extension', 'text' => 'A new living space added to an existing house often deliberately takes on a different character. Aluminium underlines that difference.'],
                ['title' => 'Where maintenance weighs heavily', 'text' => 'Anyone wanting to keep maintenance on exterior joinery to a minimum often ends up at aluminium. What that means concretely we discuss on the basis of your situation.'],
                ['title' => 'For a combination of materials', 'text' => 'Wood on the street side, aluminium on the garden side — or the other way round. We match colours and divisions so the whole hangs together.'],
            ],

            'options' => [
                ['title' => 'Division and way of opening', 'text' => 'Fixed lights, opening or tilting lights, or a sliding solution. The choice determines the use as much as how much profile stays visible.'],
                ['title' => 'Colour and finish', 'text' => 'The finish colour we discuss together; it largely decides whether the joinery asserts itself or disappears into the façade.'],
                ['title' => 'Relation to the glazed area', 'text' => 'The larger the glazed area, the heavier the structure and hardware have to be. What is achievable in your case we look at when measuring.'],
                ['title' => 'Combination with wood', 'text' => 'Aluminium and wood side by side is possible, provided the divisions and colours are matched. That is exactly the sort of judgement we spend time on beforehand.'],
                ['title' => 'Connection to the façade', 'text' => 'Sills, insulation and internal finishes are part of the window. We look at the complete connection, not only at the profile.'],
            ],

            'werkwijze_intro' => 'For aluminium windows too we follow the same process:',

            'materials' => [
                'On technical performance — insulation values, acoustic reduction, burglary resistance — we deliberately make no claims on this page. Those depend on the actual execution, and putting figures on them before your project has been looked at serves no purpose.',
                'What we do is work out together what the façade and the use call for, and build a proposal on that. If wood turns out to be the better choice in your case, we say so too.',
            ],

            'faq' => [
                ['q' => 'Do you make aluminium windows in your own workshop?', 'a' => 'Our workshop is set up for solid wood. How an aluminium job runs with us in practice is discussed beforehand, so it is clear in advance what we take on.'],
                ['q' => 'Can I combine wood and aluminium in the same house?', 'a' => 'Yes, and it happens more often than you might think: wood where the look counts, aluminium where the profile has to stay as slim as possible. We match colours and divisions.'],
                ['q' => 'What insulation value do aluminium windows reach?', 'a' => 'That depends entirely on the execution and the glazing. We do not quote a figure in advance; the quotation carries the data belonging to the chosen execution.'],
                ['q' => 'Is aluminium maintenance-free?', 'a' => 'Low-maintenance is a more honest word than maintenance-free. What it asks for in practice depends on the position and the finish; we discuss that concretely.'],
                ['q' => 'Can existing windows be replaced with aluminium?', 'a' => 'They can, but it is not always the best choice. On an older façade a slim profile sometimes gives a look that does not suit the house. We say so when that is our view.'],
                ['q' => 'How do I request a proposal?', 'a' => 'Through the contact form, preferably with photos of the situation and a short description of what you have in mind. We will tell you what we need in order to take it further.'],
                ['q' => 'Can you supply large sliding glazed units as well?', 'a' => 'That depends on the dimensions and on what the structure allows. With large sliding units the weight and the running gear decide what is achievable; we look at that when measuring on site.'],
            ],

            'cta_heading' => 'A project involving aluminium joinery?',
            'cta_text'    => 'Tell us what you have in mind and what it involves. We will look together at which material suits best.',
        ],

        /* ── Garage doors ───────────────────────────────────────────────── */
        'garagepoorten' => [
            'name'             => 'Garage doors',
            'teaser'           => 'A door used every day that also takes up a large part of the façade.',
            'meta_title'       => 'Garage doors made to measure in solid wood | Van Kerkhoven',
            'meta_description' => 'Wooden garage doors made to measure, fitted into the existing façade opening. From measuring to installation by Van Kerkhoven of Huldenberg.',
            'h1'               => 'Garage doors made to measure',
            'hero_intro'       => 'A garage door is straight away one of the largest surfaces in a façade. So it has to work and to sit well with the rest.',
            'service_type'     => 'Made-to-measure garage doors',

            'what_heading' => 'What a made-to-measure garage door involves',
            'what'         => [
                'A garage door differs from other exterior joinery on two counts: size and use. It is large, it is heavy, and it opens and closes daily. That makes the structure and the hardware at least as important as the appearance.',
                'So with a gate we start from the opening and from the fixing points. A gate in an open driveway stands in the wind differently from a gate between two walls, and a masonry opening in an older house is rarely the same width all the way across. We take those dimensions ourselves.',
                'On top of that, the door determines a large part of the façade. It often pays to execute the gate, the adjoining door and the rest of the exterior joinery in the same species and finish, so the façade stays one whole.',
            ],
            'highlights' => [
                'Measured in the existing opening',
                'Structure and hardware sized for the weight',
                'Finish matchable to the rest of the façade',
                'Installed and adjusted by our own team',
            ],

            'when' => [
                ['title' => 'For a worn-out gate', 'text' => 'The gate hangs crooked, no longer closes, or the timber has had it. We measure the opening afresh rather than trusting the dimensions of the old gate.'],
                ['title' => 'During a façade renovation', 'text' => 'If the façade is being tackled anyway, this is the moment to match gate, door and windows.'],
                ['title' => 'For a converted farmstead or outbuilding', 'text' => 'Large openings in older buildings need a structure sized for the span. That is where made-to-measure makes the difference.'],
                ['title' => 'In new build', 'text' => 'The opening is fixed on the drawing; the earlier we look in, the simpler the connection to the masonry and the sill becomes.'],
            ],

            'options' => [
                ['title' => 'Way of opening', 'text' => 'Swinging in two leaves, or another solution that suits the opening. What is possible in your case depends on the opening, the driveway and the space inside; we look at that on site.'],
                ['title' => 'Division of the surface', 'text' => 'Vertical boards, a horizontal line, or a surface with no visible division. On a large area you see that choice immediately.'],
                ['title' => 'Hardware', 'text' => 'Hinges, locking and guides are chosen on the basis of the weight and the daily use. On a gate that is not a detail.'],
                ['title' => 'Connection to the façade', 'text' => 'A gate rarely stands alone: there is a door beside it, a sill below and masonry around it. Those connections help decide how long the whole stays good.'],
                ['title' => 'Finish', 'text' => 'Painted, stained or finished transparently. What is sensible goes together with the position and the exposure of the gate; we discuss that before the choice is fixed.'],
            ],

            'werkwijze_intro' => 'For a garage door the process looks like this:',

            'materials' => [
                'We work in solid wood. On a gate the build-up counts for even more: a large surface that moves daily has to stay stable. That helps decide which species and which construction make sense.',
                'We make no promises about powered operation on this page. If you want it, raise it at first contact, so it is clear straight away what we take on.',
            ],

            'faq' => [
                ['q' => 'Do you measure the existing opening?', 'a' => 'Always. We take the opening, the fixing points and the floor level ourselves; the dimensions of the old gate are rarely still accurate.'],
                ['q' => 'Can the gate have the same finish as the rest of the joinery?', 'a' => 'Yes, and that is usually the advice too. Gate, door and windows in the same species and finish give a far calmer façade.'],
                ['q' => 'Can you make a gate for a large opening in a farmstead or outbuilding?', 'a' => 'That is possible. On large spans the structure decides the result; we look on site at what is achievable.'],
                ['q' => 'Do you also supply powered gates?', 'a' => 'Raise it at first contact. Then we can say straight away what we can take on in your case, rather than having to adjust it afterwards.'],
                ['q' => 'How much maintenance does a wooden gate need?', 'a' => 'That depends on the position and the finish. A south-facing gate with no shelter needs more attention than one in the shade. We say beforehand what to expect.'],
                ['q' => 'Do you fit the gate yourselves?', 'a' => 'Yes, with our own installation team — including the adjustment after fitting.'],
                ['q' => 'Can a separate pedestrian door go beside the gate?', 'a' => 'Yes, that is a much-requested combination: a pedestrian door next to the gate in the same species and finish, so you do not have to open the whole gate every time.'],
            ],

            'cta_heading' => 'A new garage door?',
            'cta_text'    => 'Send us a photo of the opening and the façade, with the dimensions if you have them. We will let you know what is possible.',
        ],

        /* ── Custom cabinets ────────────────────────────────────────────── */
        'maatkasten' => [
            'name'             => 'Custom cabinets',
            'teaser'           => 'Built-in cabinets that follow the space that is actually there — including under a sloping roof or in a lost corner.',
            'meta_title'       => 'Built-in and custom cabinets to measure | Van Kerkhoven',
            'meta_description' => 'Built-in cabinets made to measure for sloping walls, alcoves and lost corners. Designed, built and fitted by Van Kerkhoven of Huldenberg.',
            'h1'               => 'Custom cabinets made to measure',
            'hero_intro'       => 'A made-to-measure cabinet fills the space that is really there — including the sloping wall, the alcove and the corner nothing standard fits into.',
            'service_type'     => 'Custom cabinets and interior joinery',

            'what_heading' => 'What made-to-measure cabinets deliver',
            'what'         => [
                'The difference between a made-to-measure cabinet and one from a shop lies in the centimetres you do not see. A standard cabinet leaves a gap at the side, a layer of dust on top and a lost strip at the back. In a built-in cabinet that space does not exist: the cabinet is the space.',
                'It gets really interesting where the space is not rectangular. Under a sloping roof, in an alcove beside a chimney breast, in a hallway that narrows, or around an existing door or window. That is exactly where standard furniture runs out and joinery begins.',
                'We design the cabinet with you: what has to go in it, how you use it, and how it relates to the rest of the room. It is then made in our own workshop, and fitted and adjusted at your place.',
            ],
            'highlights' => [
                'Designed around the real space',
                'Sloping walls, alcoves and corners',
                'Internal layout matched to the use',
                'Made in our workshop, fitted by our team',
            ],

            'when' => [
                ['title' => 'Under a sloping roof', 'text' => 'A loft or bedroom with a roof slope is the classic situation where standard cabinets deliver little and made-to-measure immediately wins space.'],
                ['title' => 'In an alcove or lost corner', 'text' => 'Spaces beside a chimney breast, under a staircase or in a recessed wall become usable as soon as the cabinet follows the shape of the space.'],
                ['title' => 'During a renovation', 'text' => 'When the layout is changing anyway, it is simpler to design the cabinets alongside it than to fit something in afterwards.'],
                ['title' => 'When the whole has to hang together', 'text' => 'Cabinets in the same finish as the interior doors or the staircase let an interior read as one thing rather than as separate purchases.'],
            ],

            'options' => [
                ['title' => 'Internal layout', 'text' => 'Shelves, hanging sections, drawers or a combination. What you keep in it determines the layout — not the other way round.'],
                ['title' => 'Doors or open', 'text' => 'Fully closed, partly open, or with open compartments at eye level. Open sections lighten a cabinet, closed sections keep a room calm.'],
                ['title' => 'Handles or handleless', 'text' => 'A visible handle or a handleless execution changes the character of the cabinet considerably, certainly over a large area.'],
                ['title' => 'Connection to the room', 'text' => 'Running to the ceiling or stopping just below, with or without a plinth — those choices decide whether the cabinet reads as furniture or as part of the wall.'],
                ['title' => 'Finish', 'text' => 'Painted, lacquered or with visible grain. We discuss it on samples, together with the rest of the interior.'],
            ],

            'werkwijze_intro' => 'For a made-to-measure cabinet it runs like this:',

            'materials' => [
                'Which materials and finish suit best depends on the place and the use: a wardrobe in a bedroom makes different demands than a store cupboard in a hallway or a built-in unit in a damper room. We go through that at the discussion.',
                'What we do not do is push a material because it is the easiest for us to work. If something is not a good idea in your situation, we say so.',
            ],

            'faq' => [
                ['q' => 'Can you make a cabinet under a sloping roof?', 'a' => 'Yes, that is one of the situations where made-to-measure delivers most. We measure the slope, the height and the roof structure and draw the cabinet around them.'],
                ['q' => 'Do you design the cabinet, or do I need to come with a plan?', 'a' => 'Either works. We often start from a sketch or from photos and work out together what has to go in and how you use it.'],
                ['q' => 'Can cabinets and interior doors have the same finish?', 'a' => 'Yes. Where we make both, we keep the species and finish the same so the interior hangs together.'],
                ['q' => 'Is the cabinet fitted at my place or delivered?', 'a' => 'We fit it ourselves and adjust on site. In a room that is not square, that adjusting is precisely the work that decides the result.'],
                ['q' => 'Do you do interior joinery other than cabinets?', 'a' => 'Yes. Bespoke work in wood — from furniture to wall panelling — is part of what we do. Do describe what you have in mind.'],
                ['q' => 'What does a made-to-measure cabinet cost?', 'a' => 'That depends too much on the dimensions, the layout and the finish to put a guide price on it. After a discussion and a measuring visit you get a quotation that applies to your situation.'],
                ['q' => 'How long does it take from discussion to installation?', 'a' => 'That depends on the size of the job and on what is running in the workshop. We state what is realistic at the time in the quotation, so you can plan the rest around it.'],
            ],

            'cta_heading' => 'A cabinet that fits exactly?',
            'cta_text'    => 'Send us photos of the space and a description of what has to go in. We will think the layout through with you.',
        ],

        /* ── Facade cladding ────────────────────────────────────────────── */
        'gevelbekleding' => [
            'name'             => 'Facade cladding',
            'teaser'           => 'Wooden cladding changes the character of a house and finishes the façade beneath it.',
            'meta_title'       => 'Wooden facade cladding for your home | Van Kerkhoven',
            'meta_description' => 'Wooden facade cladding for renovation and new build, matched to windows, doors and the rest of the façade. Carried out by Van Kerkhoven of Huldenberg.',
            'h1'               => 'Facade cladding in wood',
            'hero_intro'       => 'A wooden façade changes a house more thoroughly than almost any other intervention — and touches everything sitting in that façade.',
            'service_type'     => 'Wooden facade cladding',

            'what_heading' => 'What wooden facade cladding involves',
            'what'         => [
                'Cladding is a finishing layer in wood that goes over the existing or new façade. It decides the look of the house in one move: the same volumes read completely differently in brick than in vertically laid timber.',
                'At the same time it is the part most bound up with the rest of the façade. Around every window, door and gate the cladding has to meet neatly, and those junctions ultimately decide whether the whole looks finished. So it is usually wise to look at cladding and exterior joinery together.',
                'We carry out cladding in renovation — where it often goes together with replacing windows and doors — and in new build, where the build-up is already in the design.',
            ],
            'highlights' => [
                'Junctions with windows, doors and gates taken into account',
                'Renovation and new build',
                'Vertical, horizontal or with a line of its own',
                'The same team as for your other exterior joinery',
            ],

            'when' => [
                ['title' => 'During a façade renovation', 'text' => 'If the façade is being tackled anyway, this is the moment: cladding and new exterior joinery in one go gives the neat junctions that are hard to achieve afterwards.'],
                ['title' => 'For an extension', 'text' => 'A timber extension against an existing brick house makes the distinction between old and new visible instead of hiding it.'],
                ['title' => 'For an outbuilding or carport', 'text' => 'A store, carport or garden room in the same cladding as the house lets the whole read as one design.'],
                ['title' => 'When the house looks too flat', 'text' => 'A façade with little relief immediately gains depth and direction from a timber line.'],
                ['title' => 'For a façade that needs attention', 'text' => 'Cladding is sometimes a way to give a tired façade a new finish. Whether that is the right solution in your case depends on what sits underneath; we look at that first.'],
            ],

            'options' => [
                ['title' => 'Direction of the boarding', 'text' => 'Vertical makes a façade look taller, horizontal wider. On a large house that is one of the most decisive choices.'],
                ['title' => 'Width and rhythm of the boards', 'text' => 'Narrow boards give a fine, busy look; wider boards a calmer surface. We look at it at the scale of your façade, not on a thirty-centimetre sample.'],
                ['title' => 'Junctions around openings', 'text' => 'Around windows, doors and gates the result stands or falls. How those edges are resolved is agreed up front.'],
                ['title' => 'Finish', 'text' => 'Left to weather grey, stained or painted. That is no detail: the choice decides both the final look and what comes later in maintenance.'],
                ['title' => 'Combination with other joinery', 'text' => 'Where we also make your windows, doors or gate, species and finish can run the same.'],
            ],

            'werkwijze_intro' => 'For cladding a job runs as follows:',

            'materials' => [
                'The choice of species and finish depends on the orientation of the façade, on how sheltered it is and on the look you want. A north elevation weathers differently from a south one, and that is no problem as long as you know beforehand.',
                'On lifespan, weathering rate and maintenance intervals we give no figures we cannot stand behind. What we do is discuss honestly what a choice is likely to mean in your situation — including when that means you would be better off choosing something else.',
            ],

            'faq' => [
                ['q' => 'Can cladding go on an existing façade?', 'a' => 'Often yes, but it depends on what is underneath. When measuring we look at the existing build-up and the junctions before proposing anything.'],
                ['q' => 'What about the junction around windows and doors?', 'a' => 'That is the most important part of the work. Where we also carry out the exterior joinery, we can resolve those edges straight away rather than fitting something around them afterwards.'],
                ['q' => 'Does wooden cladding have to be treated?', 'a' => 'That is a choice, not an obligation. Untreated wood weathers grey; treated wood holds its colour longer but needs attention. We go through what suits your façade.'],
                ['q' => 'Can you clad a carport or store as well?', 'a' => 'Yes. Timber structures and cladding for carports, canopies and outbuildings are part of our work.'],
                ['q' => 'Can I clad only part of the façade?', 'a' => 'Certainly. Often just one elevation or one volume is done in timber, precisely to make it stand out.'],
                ['q' => 'What do you need in order to price it?', 'a' => 'Send photos of the façade and, if you have them, the dimensions. The more concrete the picture, the sooner we can say what is achievable.'],
                ['q' => 'Do you work with the contractor or the architect?', 'a' => 'Regularly, and with cladding it is often necessary: the build-up behind the timber, the insulation and the junctions touch the work of other trades. We take that coordination on.'],
            ],

            'cta_heading' => 'A wooden façade for your home?',
            'cta_text'    => 'Send us photos of the façade and a short description of what you have in mind.',
        ],

    ],

];
