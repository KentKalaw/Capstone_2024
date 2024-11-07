<script>
      function loadProvinces(value) {
    var region = value;
    var provinces = {
        'Region I – Ilocos Region': ['Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'],
        'Region II – Cagayan Valley': ['Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'],
        'Region III – Central Luzon': ['Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'],
        'Region IV A – CALABARZON': ['Batangas', 'Laguna', 'Quezon', 'Rizal', 'Cavite'],
        'MIMAROPA Region': ['Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'],
        'Region V – Bicol Region': ['Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Sorsogon', 'Masbate'],
        'Region VI – Western Visayas': ['Aklan', 'Antique', 'Capiz', 'Iloilo', 'Negros Occidental'],
        'Region VII – Central Visayas': ['Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'],
        'Region VIII – Eastern Visayas': ['Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Southern Leyte', 'Western Samar'],
        'Region IX – Zamboanga Peninsula': ['Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'],
        'Region X – Northern Mindanao': ['Camiguin', 'Misamis Occidental', 'Misamis Oriental', 'Bukidnon', 'Lanao del Norte'],
        'Region XI – Davao Region': ['Davao del Norte', 'Davao del Sur', 'Davao Oriental', 'Davao Occidental', 'Compostela Valley'],
        'Region XII – SOCCSKSARGEN': ['South Cotabato', 'Sultan Kudarat', 'General Santos City', 'Cotabato'],
        'Region XIII – Caraga': ['Agusan del Norte', 'Agusan del Sur', 'Surigao del Norte', 'Surigao del Sur', 'Dinagat Islands'],
        'NCR – National Capital Region': ['Metro Manila'],
        'CAR – Cordillera Administrative Region': ['Abra', 'Apayao', 'Bineng', 'Mountain Province', 'Ifugao', 'Kalinga'],
        'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao': ['Basilan', 'Lanao del Sur', 'Maguindanao', 'Sulu', 'Tawi-Tawi']
    };

    var provinceOptions = '<option selected disabled>Choose province...</option>';
    if (provinces[region]) {
        provinces[region].forEach(function(province) {
            provinceOptions += '<option>' + province + '</option>';
        });
    }
    document.getElementById('province1').innerHTML = '<select placeholder="Province" name="province" id="province" onchange="loadcity(this.value)">' + provinceOptions + '</select>';
}
</script>

<script>
function loadcity(value) {
    var province = value;
    var cities = {
    'Batangas': ['Batangas City', 'Lipa City', 'Tanauan City', 'Calaca', 'Calatagan', 'Cuenca', 'Ibaan', 'Laurel', 'Lian', 'Lobo', 'Mabini', 'Malvar', 'Mataas na kahoy', 'Nasugbu', 'Padre Garcia', 'Rosario', 'San Jose', 'San Juan', 'San Luis', 'San Nicolas', 'San Pascual', 'Santa Teresita', 'Santo Tomas', 'Taal', 'Talisay', 'Tingloy', 'Tuy'],
    'Laguna': ['Alaminos', 'Bay', 'Biñan', 'Cabuyao', 'Calamba', 'Calauan', 'Candelaria', 'Famy', 'Kalayaan', 'Liliw', 'Los Baños', 'Luisiana', 'Lumban', 'Mabitac', 'Magdalena', 'Majayjay', 'Nagcarlan', 'Paete', 'Pagsanjan', 'Pakil', 'Pila', 'Rizal', 'San Pablo', 'San Pedro', 'Santa Cruz', 'Santa Maria', 'Santo Tomas', 'Siniloan', 'Victoria'],
    'Quezon': ['Agdangan', 'Alabat', 'Atimonan', 'Buenavista', 'Burdeos', 'Candelaria', 'Catanauan', 'Dolores', 'General Luna', 'General Nakar', 'Guinayangan', 'Infanta', 'Jomalig', 'Luisiana', 'Macalelon', 'Mauban', 'Mulanay', 'Padre Burgos', 'Pagbilao', 'Panukulan', 'Patnanungan', 'Pitogo', 'Plaridel', 'Quezon', 'Real', 'Sampaloc', 'San Andres', 'San Antonio', 'San Francisco', 'San Narciso', 'San Pascual', 'Sariaya', 'Tagkawayan', 'Tiaong', 'Unisan'],
    'Rizal': ['Angono', 'Antipolo', 'Baras', 'Binangonan', 'Cainta', 'Cardona', 'Jala-Jala', 'Morong', 'San Isidro', 'San Juan', 'San Mateo', 'Tanay', 'Taytay', 'Teresa'],
    'Cavite': ['Amadeo', 'Bacoor', 'Carmona', 'Cavite City', 'Dasmariñas', 'General Emilio Aguinaldo', 'General Trias', 'Imus', 'Indang', 'Kawit', 'Magallanes', 'Maragondon', 'Mendez', 'Naic', 'Noveleta', 'Rosario', 'Silang', 'Tagaytay', 'Tanza', 'Ternate'],
    'Metro Manila': ['Caloocan City', 'Las Piñas City', 'Makati City', 'Malabon City', 'Mandaluyong City', 'Manila City', 'Marikina City', 'Muntinlupa City', 'Navotas City', 'Parañaque City', 'Pasay City', 'Pasig City', 'Pateros', 'Quezon City', 'San Juan City', 'Taguig City', 'Valenzuela City'],
    'Pampanga': ['Angeles City', 'San Fernando City', 'Mabalacat City', 'Apalit', 'Arayat', 'Bacolor', 'Candaba', 'Floridablanca', 'Guagua', 'Lubao', 'Macabebe', 'Magalang', 'Masantol', 'Mexico', 'Minalin', 'Porac', 'San Luis', 'San Simon', 'Santa Ana', 'Santa Rita', 'Santo Tomas', 'Sasmuan'],
    'Bulacan': ['Malolos City', 'Meycauayan City', 'San Jose del Monte City'],
    'Nueva Ecija': ['Cabanatuan City', 'Gapan City', 'Science City of Muñoz', 'Palayan City', 'San Jose City'],
    'Tarlac': ['Tarlac City'],
    'Zambales': ['Olongapo City'],
    'Aurora': ['Baler'],
    'Bataan': ['Balanga City'],
    'Cagayan': ['Tuguegarao City'],
    'Isabela': ['Cauayan City', 'Ilagan City', 'Santiago City'],
    'Nueva Vizcaya': ['Bayombong', 'Solano'],
    'Quirino': ['Cabarroguis'],
    'Ilocos Norte': ['Laoag City'],
    'Ilocos Sur': ['Vigan City', 'Candon City'],
    'La Union': ['San Fernando City'],
    'Pangasinan': ['Alaminos City', 'Dagupan City', 'San Carlos City', 'Urdaneta City'],
    'Benguet': ['Baguio City'],
    'Ifugao': ['Lagawe'],
    'Kalinga': ['Tabuk City'],
    'Apayao': ['Kabugao'],
    'Mountain Province': ['Bontoc'],
    'Abra': ['Bangued'],
    'Iloilo': ['Iloilo City', 'Passi City'],
    'Antique': ['San Jose de Buenavista'],
    'Capiz': ['Roxas City'],
    'Aklan': ['Kalibo'],
    'Negros Occidental': ['Bacolod City', 'Bago City', 'Cadiz City', 'Escalante City', 'Himamaylan City', 'Kabankalan City', 'La Carlota City', 'Sagay City', 'San Carlos City', 'Silay City', 'Sipalay City', 'Talisay City', 'Victorias City'],
    'Bohol': ['Tagbilaran City'],
    'Cebu': ['Cebu City', 'Mandaue City', 'Lapu-Lapu City', 'Danao City', 'Toledo City', 'Bogo City', 'Carcar City', 'Naga City', 'Talisay City'],
    'Negros Oriental': ['Dumaguete City', 'Bais City', 'Bayawan City', 'Canlaon City', 'Guihulngan City', 'Tanjay City'],
    'Leyte': ['Tacloban City', 'Ormoc City', 'Baybay City'],
    'Samar': ['Calbayog City', 'Catbalogan City'],
    'Eastern Samar': ['Borongan City'],
    'Southern Leyte': ['Maasin City'],
    'Zamboanga del Norte': ['Dipolog City', 'Dapitan City'],
    'Zamboanga del Sur': ['Pagadian City'],
    'Zamboanga City': ['Zamboanga City'],
    'Bukidnon': ['Malaybalay City', 'Valencia City'],
    'Misamis Occidental': ['Oroquieta City', 'Ozamiz City', 'Tangub City'],
    'Misamis Oriental': ['Cagayan de Oro City', 'Gingoog City', 'El Salvador City'],
    'Davao del Norte': ['Tagum City', 'Panabo City', 'Samal City'],
    'Davao del Sur': ['Digos City'],
    'Davao City': ['Davao City'],
    'Davao Oriental': ['Mati City'],
    'South Cotabato': ['General Santos City', 'Koronadal City'],
    'North Cotabato': ['Kidapawan City'],
    'Agusan del Norte': ['Butuan City', 'Cabadbaran City'],
    'Agusan del Sur': ['Bayugan City'],
    'Surigao del Norte': ['Surigao City'],
    'Surigao del Sur': ['Tandag City', 'Bislig City'],
    'Lanao del Sur': ['Marawi City'],
    'Maguindanao': ['Cotabato City'],
    'Basilan': ['Isabela City', 'Lamitan City'],
    'Lanao del Norte': ['Iligan City', 'Bacolod', 'Kapatagan', 'Sultan Naga Dimaporo', 'Pantao Ragat', 'Poona Piagapo', 'Baroy', 'Kauswagan', 'Linamon', 'Matungao', 'Salvador', 'Sapad', 'Tagoloan', 'Tangcal', 'Tubod'],
    'Compostela Valley': ['Nabunturan', 'Maco', 'Mawab', 'Montevista', 'New Bataan', 'Pantukan'],
    'Davao Occidental': ['Malita', 'Santa Maria', 'Sarangani', 'Don Marcelino', 'Jose Abad Santos'],
    'Sarangani': ['Alabel', 'Glan', 'Kiamba', 'Maasim', 'Maitum', 'Malapatan'],
    'Sultan Kudarat': ['Isulan', 'Tacurong City', 'Bagumbayan', 'Columbio', 'Esperanza', 'Kalamansig', 'Lambayong', 'Lebak', 'Lutayan', 'Palimbang', 'President Quirino', 'Sen. Ninoy Aquino'],
    'Camiguin:': ['Mambajao', 'Mahinog', 'Sagay', 'Guinsiliban', 'Catarman'],
};

    var cityOptions = '<option selected disabled>Choose city...</option>';
    if (cities[province]) {
        cities[province].forEach(function(city) {
            cityOptions += '<option>' + city + '</option>';
        });
    }
    document.getElementById('city1').innerHTML = '<select placeholder="City" name="city" id="city">' + cityOptions + '</select>';
}
</script>


