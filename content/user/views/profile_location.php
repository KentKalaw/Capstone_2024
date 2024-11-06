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
    'Batangas': ['Batangas City', 'Lipa City', 'Tanauan City', 'Calaca City', 'Santo Tomas City'],
    'Laguna': ['Calamba City', 'San Pablo City', 'Santa Rosa City', 'San Pedro City', 'Biñan City', 'Cabuyao City'],
    'Quezon': ['Lucena City', 'Tayabas City'],
    'Rizal': ['Antipolo City'],
    'Cavite': ['Bacoor City', 'Cavite City', 'Dasmariñas City', 'Imus City', 'Tagaytay City', 'Trece Martires City', 'General Trias City'],
    'Metro Manila': ['Caloocan City', 'Las Piñas City', 'Makati City', 'Malabon City', 'Mandaluyong City', 'Manila City', 'Marikina City', 'Muntinlupa City', 'Navotas City', 'Parañaque City', 'Pasay City', 'Pasig City', 'Pateros', 'Quezon City', 'San Juan City', 'Taguig City', 'Valenzuela City'],
    'Pampanga': ['Angeles City', 'San Fernando City'],
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
    'Sultan Kudarat': ['Tacurong City'],
    'Agusan del Norte': ['Butuan City', 'Cabadbaran City'],
    'Agusan del Sur': ['Bayugan City'],
    'Surigao del Norte': ['Surigao City'],
    'Surigao del Sur': ['Tandag City', 'Bislig City'],
    'Lanao del Sur': ['Marawi City'],
    'Maguindanao': ['Cotabato City'],
    'Basilan': ['Isabela City', 'Lamitan City']
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
                    </script>