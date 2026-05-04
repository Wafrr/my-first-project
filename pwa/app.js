const noteInput = document.getElementById("noteInput");
const saveBtn = document.getElementById("saveBtn");
const clearBtn = document.getElementById("clearBtn");
const message = document.getElementById("message");

const notesList = document.getElementById("notesList");
const statusText = document.querySelector("#status");
const checkBtn = document.querySelector("#checkBtn");

const STORAGE_KEY = "notes";

// Получить все заметки из localStorage
function getNotes() {
  const notes = localStorage.getItem(STORAGE_KEY);

  if (notes) {
    return JSON.parse(notes);
  }

  return [];
}

// Сохранить массив заметок в localStorage
function setNotes(notes) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(notes));
}

// Показать заметки на странице
function renderNotes() {
  const notes = getNotes();

  notesList.innerHTML = "";

  if (notes.length === 0) {
    notesList.innerHTML = "<p class='empty'>Пока заметок нет</p>";
    return;
  }

  notes.forEach(function (note, index) {
    const noteCard = document.createElement("div");
    noteCard.className = "note-card";

    const noteText = document.createElement("p");
    noteText.textContent = note;

    const deleteBtn = document.createElement("button");
    deleteBtn.textContent = "Удалить";

    deleteBtn.addEventListener("click", function () {
      deleteNote(index);
    });

    noteCard.appendChild(noteText);
    noteCard.appendChild(deleteBtn);

    notesList.appendChild(noteCard);
  });
}

// Добавить новую заметку
function addNote() {
  const noteText = noteInput.value.trim();

  if (noteText === "") {
    message.textContent = "Введите текст заметки";
    return;
  }

  const notes = getNotes();

  notes.push(noteText);
  setNotes(notes);

  noteInput.value = "";
  message.textContent = "Заметка сохранена";

  renderNotes();
}

// Удалить одну заметку
function deleteNote(index) {
  const notes = getNotes();

  notes.splice(index, 1);
  setNotes(notes);

  message.textContent = "Заметка удалена";

  renderNotes();
}

// Очистить все заметки
function clearAllNotes() {
  localStorage.removeItem(STORAGE_KEY);

  noteInput.value = "";
  message.textContent = "Все заметки очищены";

  renderNotes();
}

// При загрузке страницы показываем сохраненные заметки
window.addEventListener("load", function () {
  renderNotes();
});

saveBtn.addEventListener("click", addNote);
clearBtn.addEventListener("click", clearAllNotes);

// Регистрация Service Worker
if ("serviceWorker" in navigator) {
  navigator.serviceWorker.register("./sw.js")
    .then(function () {
      statusText.textContent = "SW зарегистрирован";
    })
    .catch(function () {
      statusText.textContent = "Ошибка регистрации. Запускайте через localhost";
    });
} else {
  statusText.textContent = "Service Worker не поддерживается";
}

// Проверка онлайн / офлайн
checkBtn.addEventListener("click", function () {
  statusText.textContent = navigator.onLine ? "Онлайн есть" : "Офлайн";
});