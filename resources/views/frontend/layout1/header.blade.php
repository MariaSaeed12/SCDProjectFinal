<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="{{ url('frontend/css/design.css') }}" /> -->

  <title>LittleHeartsHealth</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: purple">
    <a class="navbar-brand" href="#"> <b>LittleHeartsHealth</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- HTML for the Search Bar -->
    <div class="search-bar-container" style="position: relative;">
      <input type="text" id="search-bar" class="form-control" placeholder="Search for doctors " autocomplete="off">
      <ul id="search-results" class="dropdown-menu" style="position: absolute; width: 100%; z-index: 1000; display: none;">
        <!-- Search results will appear here -->
      </ul>
    </div>

    @php
    $navItems = [
    ['route' => 'home', 'label' => 'Home'],
    ['route' => 'about', 'label' => 'About Us'],
    ['route' => 'contact', 'label' => 'Contact Us'],
    ['route' => 'doctors', 'label' => 'Doctors'],
    ];
    @endphp

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @foreach ($navItems as $item)
        <li class="nav-item">
          <a class="nav-link {{ Route::currentRouteName() == $item['route'] ? 'active' : '' }}" href="{{ route($item['route']) }}">
            <b>{{ $item['label'] }}</b>
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </nav>
</body>

<script>
  // document.addEventListener('DOMContentLoaded', function() {
  //   console.log('Search script loaded');
  //   const searchBar = document.getElementById('search-bar');
  //   const searchResults = document.getElementById('search-results');

  //   // Event listener for search bar input
  //   searchBar.addEventListener('input', function() {
  //     const query = searchBar.value.trim();

  //     if (query.length > 0) {
  //       // AJAX request to fetch search results
  //       fetch(`/search-doctors?query=${encodeURIComponent(query)}`)
  //         .then(response => response.json())
  //         .then(data => {
  //           // Clear previous results
  //           searchResults.innerHTML = '';

  //           // Check if there are results
  //           if (data.doctors.length > 0) {
  //             data.doctors.forEach(doctor => {
  //               const li = document.createElement('li');
  //               li.className = 'dropdown-item';
  //               li.innerHTML = `
  //                               <img src="/images/${doctor.profile_picture}" alt="${doctor.name}" style="width: 40px; height: 40px; margin-right: 10px;">
  //                               <span>${doctor.name}</span> - ${doctor.specialization}
  //                           `;
  //               searchResults.appendChild(li);
  //             });

  //             searchResults.style.display = 'block';
  //           } else {
  //             searchResults.style.display = 'none';
  //           }
  //         })
  //         .catch(error => console.error('Error fetching search results:', error));
  //     } else {
  //       searchResults.style.display = 'none';
  //     }
  //   });
  // });
  function debounce(func, delay) {
    let debounceTimer;
    return function() {
      const context = this;
      const args = arguments;
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => func.apply(context, args), delay);
    };
  }

  document.getElementById('search-bar').addEventListener('input', debounce(function() {
    const query = this.value.trim();
    let resultsContainer = document.getElementById('search-results');

    if (query.length > 0) {
      fetch(`/search-doctors?query=${query}`)
        .then(response => response.json())
        .then(data => {
          resultsContainer.innerHTML = '';

          if (data.length === 0) {
            let li = document.createElement('li');
            li.classList.add('dropdown-item');
            li.innerHTML = 'No results found';
            resultsContainer.appendChild(li);
            resultsContainer.style.display = 'block';
            return;
          }

          // [DOCTOR SEARCH - OLD STYLING - START]
          //
          // const li = document.createElement('li');
          // li.className = 'dropdown-item';
          // li.innerHTML = `
          // <img src="/images/${doctor.profile_picture}" alt="${doctor.name}" style="width: 40px; height: 40px; margin-right: 10px;">
          // <span>${doctor.name}</span> - ${doctor.specialization}
          // `;
          // searchResults.appendChild(li);
          //
          // [DOCTOR SEARCH - OLD STYLING - END]

          data.forEach((item, idx) => {
            let li = document.createElement('li');
            li.classList.add('dropdown-item');
            li.innerHTML = `<strong>${item.name}</strong><br>
                                        <small>${item.phone_number}</small><br>
                                        <small>${item.specialty}</small>`;

            // Alternate background color for search results
            if (idx % 2 === 0) {
              li.style.backgroundColor = '#00005522';
            }

            resultsContainer.appendChild(li);
          });
          resultsContainer.style.display = 'block';
        })
        .catch(err => {
          console.error('Error fetching search results:', err);
          resultsContainer.style.display = 'none';
        });
    } else {
      resultsContainer.style.display = 'none';
    }
  }, 300));
</script>