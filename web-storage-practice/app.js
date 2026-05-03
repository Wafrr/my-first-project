const noteInput = document.getElementById('noteInput');
const saveBtn = document.getElementById('saveBtn');
const clearBtn = document.getElementById('clearBtn');

const STORAGE_KEY = 'user_note';

function loadNote() {
    const savedNote = localStorage.getItem(STORAGE_KEY);
    
    if (savedNote !== null) {
        noteInput.value = savedNote;
        console.log('Заметка восстановлена из localStorage');
    } else {
        console.log('Сохраненных заметок не найдено');
    }
}

function saveNote() {
    const noteText = noteInput.value;
    
    if (noteText.trim() === '') {
        if (confirm('Заметка пуста. Всё равно сохранить?')) {
            localStorage.setItem(STORAGE_KEY, noteText);
            console.log('Пустая заметка сохранена');
        }
    } else {
        localStorage.setItem(STORAGE_KEY, noteText);
        console.log('Заметка сохранена в localStorage');
        
        showTemporaryMessage('Сохранено!');
    }
}

function clearNote() {
    if (confirm('Вы уверены, что хотите удалить заметку?')) {
        noteInput.value = '';
        
        localStorage.removeItem(STORAGE_KEY);
        
        console.log('Заметка удалена из localStorage');
        
        showTemporaryMessage('Заметка удалена');
    }
}

function showTemporaryMessage(message) {
    const infoElement = document.querySelector('.info p');
    const originalText = infoElement.textContent;
    
    infoElement.textContent = message;
    infoElement.style.background = '#d4edda';
    infoElement.style.color = '#155724';
    
    setTimeout(() => {
        infoElement.textContent = originalText;
        infoElement.style.background = '#f0f0f0';
        infoElement.style.color = '#888';
    }, 2000);
}

saveBtn.addEventListener('click', saveNote);
clearBtn.addEventListener('click', clearNote);

loadNote();

window.addEventListener('beforeunload', () => {
    localStorage.setItem(STORAGE_KEY, noteInput.value);
});