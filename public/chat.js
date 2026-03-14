/**
 * Простий клієнтський чат: відправка повідомлень і оновлення блоку чату.
 * Використовує глобальну функцію chatSend(event) для submit форми.
 */
function chatSend(e) {
  e.preventDefault();
  const form = e.target;
  const name = form.name.value.trim();
  const text = form.text.value.trim();
  if (!name || !text) return;
  const box = document.getElementById('chatBox');
  const line = document.createElement('div');
  line.className = 'px-3 py-2 border-bottom';
  line.textContent = name + ': ' + text;
  box.appendChild(line);
  box.scrollTop = box.scrollHeight;
  form.text.value = '';
}
