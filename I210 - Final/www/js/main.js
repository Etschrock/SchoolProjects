function confirm_deletion(id) {
    buttons = "<div style='color:red; font-size:small'> Are you sure you wanted to delete the book?<br><br>";
    buttons += "<input type='button' onclick=window.location.href='deletebook.php?id=" + id + "' value='  Delete  ' >";
    buttons += " <input type='button' onclick='cancel_deletion(" + id + ")' value='  Cancel  ' ></div>";
    
    document.getElementById("delete-buttons").innerHTML = buttons;
}

function cancel_deletion(id) {
    buttons = "<div><input type='button' value='  Delete Book  ' onclick='confirm_deletion(" + id + ")'></div>";
    document.getElementById("delete-buttons").innerHTML = buttons;
}