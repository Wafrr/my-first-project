const API_URL = 'http://localhost:3000/api/requests';

const form = document.getElementById('request-form');
const requestsList = document.getElementById('requests-list');
const networkStatus = document.getElementById('network-status');
const statusFilter = document.getElementById('status-filter');
const priorityFilter = document.getElementById('priority-filter');

let requests = [];

function updateNetworkStatus() {
  if (navigator.onLine) {
    networkStatus.textContent = '🟢 Online';
    networkStatus.className = 'online';
  } else {
    networkStatus.textContent = '🔴 Offline';
    networkStatus.className = 'offline';
  }
}

window.addEventListener('online', async () => {
  updateNetworkStatus();

  await syncOfflineRequests();

  await loadRequests();
});

window.addEventListener('offline', updateNetworkStatus);

updateNetworkStatus();

function saveOfflineRequest(request) {
  const offlineRequests =
    JSON.parse(localStorage.getItem('offlineRequests')) || [];

  offlineRequests.push(request);

  localStorage.setItem(
    'offlineRequests',
    JSON.stringify(offlineRequests)
  );
}

async function syncOfflineRequests() {
  const offlineRequests =
    JSON.parse(localStorage.getItem('offlineRequests')) || [];

  if (!offlineRequests.length) return;

  for (const request of offlineRequests) {
    try {
      await fetch(API_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(request)
      });
    } catch (error) {
      console.error('Ошибка синхронизации:', error);
    }
  }

  localStorage.removeItem('offlineRequests');
}

async function loadRequests() {
  try {
    const response = await fetch(API_URL);

    if (!response.ok) {
      throw new Error('Ошибка загрузки заявок');
    }

    requests = await response.json();

    localStorage.setItem(
      'cachedRequests',
      JSON.stringify(requests)
    );

    renderRequests();
  } catch (error) {
    console.error(error);

    requests =
      JSON.parse(localStorage.getItem('cachedRequests')) || [];

    renderRequests();
  }
}

function renderRequests() {
  const statusValue = statusFilter.value;
  const priorityValue = priorityFilter.value;

  let filteredRequests = [...requests];

  if (statusValue !== 'all') {
    filteredRequests = filteredRequests.filter(
      request => request.status === statusValue
    );
  }

  if (priorityValue !== 'all') {
    filteredRequests = filteredRequests.filter(
      request => request.priority === priorityValue
    );
  }

  requestsList.innerHTML = '';

  if (!filteredRequests.length) {
    requestsList.innerHTML = `
      <div class="card">
        <p>Заявок пока нет</p>
      </div>
    `;

    return;
  }

  filteredRequests.forEach(request => {
    const card = document.createElement('div');

    card.className = 'card';

    card.innerHTML = `
      <div class="card-header">
        <h3>${request.title}</h3>

        <span class="tag ${request.priority}">
          ${request.priority}
        </span>
      </div>

      <p>${request.description || 'Без описания'}</p>

      <div class="card-footer">
        <strong>Status:</strong> ${request.status}
      </div>
    `;

    requestsList.appendChild(card);
  });
}

form.addEventListener('submit', async event => {
  event.preventDefault();

  const request = {
    title: document.getElementById('title').value,
    description: document.getElementById('description').value,
    priority: document.getElementById('priority').value,
    status: 'open'
  };

  if (!navigator.onLine) {
    saveOfflineRequest(request);

    requests.unshift({
      ...request,
      localOnly: true
    });

    renderRequests();

    form.reset();

    return;
  }

  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(request)
    });

    if (!response.ok) {
      throw new Error('Ошибка создания заявки');
    }

    const newRequest = await response.json();

    requests.unshift(newRequest);

    renderRequests();

    form.reset();
  } catch (error) {
    console.error(error);
  }
});

statusFilter.addEventListener('change', renderRequests);
priorityFilter.addEventListener('change', renderRequests);

if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('./sw.js');
}

loadRequests();