function clearForm() {
    document.getElementById('filter-form').reset();
    document.getElementById('key_words').value = null;
    document.getElementById('dropdown-room-input').value = null;
    document.getElementById('dropdown-bathroom-input').value = null;
    document.getElementById('min_price').value = null;
    document.getElementById('max_price').value = null;

    document.getElementById('filter-form').submit();
    return false;
}