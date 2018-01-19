const ZoneTelechargement = require('zone-telechargement');
 
ZoneTelechargement.search('star wars')
    .then(results => {
        console.log(results);
        document.write(results);
    });