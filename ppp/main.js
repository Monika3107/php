function tableClick(id,fname,sname,email) {
  document.getElementById('sid').value = id;
  document.getElementById('fname').value = fname;
  document.getElementById('sname').value = sname;
  document.getElementById('email').value = email;
}

function refreshPage() {
  setTimeout("location.reload(true);",5000);
  console.log("refreshing");
}
