
const showHideBtn = document.querySelectorAll('.show-hide-btn');

showHideBtn.forEach(btn => {
btn.addEventListener('click', () => {
const input = btn.previousElementSibling;

if (input.type === 'password') {
input.type = 'text';
btn.innerHTML = '<i class="fa fa-eye-slash"></i>';
} else {
input.type = 'password';
btn.innerHTML = '<i class="fa fa-eye"></i>';
}
});
});
