function getPokeData() {

    fetch(`https://pokeapi.co/api/v2/pokemon/${document.getElementById('poke_input').value.toLowerCase().trim()}`)
        .then(
            response => response.json()
        )
        .then(data => {
            document.getElementById('poke_data').innerHTML = `<img src="${data.sprites.front_default}" alt="${data.name}">`;
            document.getElementById('poke_name').innerHTML = data.name.toUpperCase();

            document.getElementById('error_mensage').innerHTML = "";
        })
        .catch(error => {
            document.getElementById('poke_data').innerHTML = `<img src="">`;
            document.getElementById('poke_name').innerHTML = "";

            document.getElementById('error_mensage').innerHTML = 
            "No se encontró el Pokémon. Intenta de nuevo.";
        });

}