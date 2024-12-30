document.addEventListener('DOMContentLoaded', function () {
    console.log('Search script loaded');
    const searchBar = document.getElementById('search-bar');
    const searchResults = document.getElementById('search-results');

    // Event listener for search bar input
    searchBar.addEventListener('input', function () {
        const query = searchBar.value.trim();

        if (query.length > 0) {
            // AJAX request to fetch search results
            fetch(`/search-doctors?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    // Clear previous results
                    searchResults.innerHTML = '';

                    // Check if there are results
                    if (data.doctors.length > 0) {
                        data.doctors.forEach(doctor => {
                            const li = document.createElement('li');
                            li.className = 'dropdown-item';
                            li.innerHTML = `
                                <img src="/images/${doctor.profile_picture}" alt="${doctor.name}" style="width: 40px; height: 40px; margin-right: 10px;">
                                <span>${doctor.name}</span> - ${doctor.specialization}
                            `;
                            searchResults.appendChild(li);
                        });

                        searchResults.style.display = 'block';
                    } else {
                        searchResults.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching search results:', error));
        } else {
            searchResults.style.display = 'none';
        }
    });
});
