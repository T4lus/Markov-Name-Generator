# Markov-Name-Generator
simple PHP class for generating name using Markov Chain

Need GCRandom Classes to work


Exemple :

		const NAME_FEED = array(
			"Acheron", "Amazon", "Antaeus", "Asgard", "Athens", 
			"Cacus", "Caspian", "Century", "Columbia", 
			"Dis", 
			"Erebus", 
			"Farinata", "Fortuna", 
			"Gagarin", "Gorgon", "Grissom", 
			"Han", "Hercules", "Herschel", "Hoc", "Hong", "Hydra", 
			"Knossos", 
			"Macedon", "Matano", "Ming", 
			"Newton", 
			"Pax", "Phoenix", "Plutus", 
			"Refuge", 
			"Sparta", "Strenuus", 
			"Tereshkova", "Theseus", 
			"Utopia", 
			"Vamshi", "Vostok", 
			"Widow", 
			"Yangtze", 
		);

		$seed = time();
        $Markov = new Markov($seed);
        $Markov->setNameList(NAME_FEED); 
        $Markov->makeList();   

        echo $Markov->makeName();


work even better with more and more name/word in the feed array.



