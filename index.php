<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('X-Robots-Tag: noindex, nofollow', true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f8a5c2">
    <link rel="shortcut icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABqklEQVQ4jZ2Tv0scURDHP7P7SGWh14mkuXJZEH8cgqUWcklAsLBbCEEJSprkD7hD/4BUISHEkMBBiivs5LhCwRQBuWgQji2vT7NeYeF7GxwLd7nl4knMwMDMfL8z876P94TMLt+8D0U0EggQSsAjwMvga8ChJAqxqjTG3m53AQTg4tXHDRH9ABj+zf6oytbEu5d78nvzcyiivx7QXBwy46XOi5z1jbM+Be+nqVfP8yzuD3FM6rzIs9YE1hqGvDf15cVunmdx7w5eYJw1pcGptC9CD4gBUuef5Ujq/BhAlTLIeFYuyfmTZgeYv+2nPt1a371P+Hm1WUPYydKf0lnePwVmh3hnlcO1uc7yvgJUDtdG8oy98kduK2KjeHI0fzCQINSXOk/vlXBUOaihAwnGWd8V5r1uhe1VIK52V6JW2D4FqHZX5lphuwEE7ooyaN7gjLMmKSwYL+pMnV+MA/6+g8RYa2Lg2RBQbj4+rll7uymLy3coiuXb5PdQVf7rKYvojAB8Lf3YUJUHfSYR3XqeLO5JXvk0dhKqSqQQoCO+s5AIxCLa2Lxc6ALcAPwS26XFskWbAAAAAElFTkSuQmCC" />

    <title>Movie and Web Series Search</title>
    <meta name="description" content="Themoviedb - Movie and Web Series Search."/>
    <?php $current_page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo '<link rel="canonical" href="'.$current_page.'" />'; ?>


    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" integrity="sha512-IgmDkwzs96t4SrChW29No3NXBIBv8baW490zk5aXvhCD8vuZM3yUSkbyTBcXohkySecyzIrUwiF/qV0cuPcL3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
      body {
        font-family: 'Roboto Mono', monospace;
        padding-top: 40px;
        min-height: 100vh;
        font-weight: 600;
        background-color: #1e1e1e;
        color: #fff;
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      .container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .field.has-addons {
        margin-bottom: 20px;
        width: 100%;
      }
      .result-item {
      background-color: #2e2e2e;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      max-width: 350px;
      width: 100%;
      box-sizing: border-box;
    }

    .result-item img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 10px;
    }

    .result-item h2 {
      font-size: 16px;
      margin-bottom: 5px;
      color: #fff;
    }

    .result-item p {
      font-size: 14px;
      color: #ccc;
      margin-bottom: 5px;
    }
      .pagination {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        width: 100%;
        flex-wrap: wrap;
      }
      .pagination button {
        margin: 5px;
        padding: 5px 10px;
        border-radius: 5px;
      }
      .button.is-primary {
        background-color: #ff4081;
        color: #fff;
        border-radius: 25px;
        font-family: 'Roboto Mono', monospace;
      }
      .button.is-primary:hover {
        background-color: #ff80ab;
      }
      .footer {
        width: 100%;
        text-align: center;
        margin-top: 20px;
        padding: 10px 0;
        background-color: #1e1e1e;
        color: #ff0;
      }
      .title.has-text-centered {
        color: #54c74e;
        font-family: 'Roboto Mono', monospace;
      }
      .input,
      .button {
        font-family: 'Roboto Mono', monospace;
      }
      .loading {
            color: #54c74e;
            margin-top: 20px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container">
  <h1 class="title has-text-centered" style="font-family: 'Fire Code', monospace;">Movie and Web Series Search</h1>
  <div class="field has-addons">
    <div class="control is-expanded">
      <input class="input" type="text" id="searchInput" placeholder="Enter movie or web series title">
    </div>
    <div class="control">
      <button class="button is-primary" onclick="search()">Search</button>
    </div>
  </div>
  <div id="results"></div>
  <div id="pagination" class="pagination"></div>
  <div id="notification-container"></div>
</div>
<footer class="footer">
  <p>&copy; 2024 Movie and Web Series Search</p><br>
</footer>

<div id="notification-container" class="notification-container"></div>

<script>
let currentPage = 1;
const resultsPerPage = 10;

async function search() {
        const searchInput = document.getElementById('searchInput').value.trim();
        if (!searchInput) {
            showNotification("Please enter a search query.", 'is-danger');
            return;
        }
        currentPage = 1;
        const loadingElement = document.createElement('div');
        loadingElement.classList.add('loading');
        loadingElement.textContent = "Loading...";
        document.getElementById('results').appendChild(loadingElement);

        try {
            const response = await fetch(`/api/search.php?query=${searchInput}&page=${currentPage}`);
            const data = await response.json();
            showResults(data.results);
            showPagination(data.total_results);
        } catch (error) {
            console.error('Error fetching data:', error);
            showNotification("An error occurred while fetching data.", 'is-danger');
        } finally {
            loadingElement.remove();
        }
    }

async function goToPage(pageNumber) {
  if (pageNumber < 1 || pageNumber === currentPage) return;

  const searchInput = document.getElementById('searchInput').value.trim();
  const response = await fetch(`/api/search.php?query=${searchInput}&page=${pageNumber}`);

  const data = await response.json();

  if (data.results && data.results.length > 0) {
    currentPage = pageNumber;
    showResults(data.results);
    showPagination(data.total_results);
  } else {
    showNoResults();
  }
}

async function getDetails(item) {
  let details;
  if (item.media_type === 'movie') {
    const response = await fetch(`/api/movie.php?id=${item.id}`);
    details = await response.json();
  } else if (item.media_type === 'tv') {
    const response = await fetch(`/api/tv.php?id=${item.id}`);
    details = await response.json();
  }
  return details;
}

function showResults(results) {
  const resultsContainer = document.getElementById('results');
  resultsContainer.innerHTML = '';

  if (results.length > 0) {
    results.forEach(async result => {
      const itemDetails = await getDetails(result);
      if (!itemDetails) return;

      const resultElement = document.createElement('div');
      resultElement.classList.add('result-item', 'box');

      let posterPath = '';
      if (itemDetails.poster_path) {
        posterPath = `<div style="text-align: center;"><img src="https://image.tmdb.org/t/p/w500${itemDetails.poster_path}" alt="${itemDetails.title || itemDetails.name} Poster" loading="lazy"></div>`;
      } else {
        posterPath = '<p>No poster available</p>';
      }

      let overview = '';
      if (itemDetails.overview) {
        overview = `<p>${itemDetails.overview}</p>`;
      } else {
        overview = '<p>No overview available</p>';
      }

      let year = '';
      if (itemDetails.release_date) {
        year = itemDetails.release_date.substring(0, 4);
      } else if (itemDetails.first_air_date) {
        year = itemDetails.first_air_date.substring(0, 4);
      } else {
        year = 'N/A';
      }

      let type = '';
      if (result.media_type === 'movie') {
        type = 'Movie';
      } else if (result.media_type === 'tv') {
        type = 'Web Series';
      }

      let categories = '';
      if (itemDetails.genres && itemDetails.genres.length > 0) {
        categories = itemDetails.genres.map(genre => genre.name).join(', ');
      } else {
        categories = 'N/A';
      }

      let cast = '';
      if (itemDetails.credits && itemDetails.credits.cast && itemDetails.credits.cast.length > 0) {
        cast = itemDetails.credits.cast.map(actor => actor.name).join(', ');
      } else {
        cast = 'N/A';
      }

      resultElement.innerHTML = `     
        <h2>${itemDetails.title || itemDetails.name}</h2><br>
        <p>Type: ${type}</p>
        <p>Year: ${year}</p><br>
        <p>Categories: ${categories}</p><br>
        <p>Cast: ${cast}</p><br><br>
        <p>Overview: ${overview}</p><br>
        ${posterPath}<br>
      `;
      resultsContainer.appendChild(resultElement);
    });
  } else {
    showNoResults();
  }
}

function showPagination(totalResults) {
  const totalPages = Math.ceil(totalResults / resultsPerPage);
  const paginationContainer = document.getElementById('pagination');
  paginationContainer.innerHTML = '';

  if (totalPages > 1) {
    const buttonsToShow = 5;
    const halfButtons = Math.floor(buttonsToShow / 2);
    let startPage = Math.max(1, currentPage - halfButtons);
    let endPage = Math.min(totalPages, startPage + buttonsToShow - 1);
    
    if (endPage - startPage < buttonsToShow - 1) {
      startPage = Math.max(1, endPage - buttonsToShow + 1);
    }

    const prevButton = document.createElement('button');
    prevButton.textContent = "Previous";
    prevButton.classList.add('button', 'is-primary');
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener('click', () => {
      goToPage(currentPage - 1);
    });
    paginationContainer.appendChild(prevButton);

    for (let i = startPage; i <= endPage; i++) {
      const pageButton = document.createElement('button');
      pageButton.textContent = i;
      pageButton.classList.add('button');
      if (i === currentPage) {
        pageButton.classList.add('is-primary');
      }
      pageButton.addEventListener('click', () => {
        goToPage(i);
      });
      paginationContainer.appendChild(pageButton);
    }

    const nextButton = document.createElement('button');
    nextButton.textContent = "Next";
    nextButton.classList.add('button', 'is-primary');
    nextButton.disabled = currentPage === totalPages;
    nextButton.addEventListener('click', () => {
      goToPage(currentPage + 1);
    });
    paginationContainer.appendChild(nextButton);
  }
}

function showNoResults() {
  const resultsContainer = document.getElementById('results');
  resultsContainer.innerHTML = '<p class="has-text-centered">No results found</p>';
  const paginationContainer = document.getElementById('pagination');
  paginationContainer.innerHTML = '';
}

function showNotification(message, type) {
  const notificationContainer = document.getElementById('notification-container');
  const notification = document.createElement('div');
  notification.classList.add('notification', type);
  notification.textContent = message;
  notificationContainer.appendChild(notification);
  setTimeout(() => {
    notification.remove();
  }, 2000);
}

</script>

</body>
</html>