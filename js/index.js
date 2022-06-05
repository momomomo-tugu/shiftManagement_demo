function check() {
    const name = document.getElementById("name");
    const email = document.getElementById("comment");
    const button = document.getElementById("button");
    if(email.value && email.value.length) {
      // 入力欄が空👉disabled解除
      button.disabled = false;
    } else {
      // 入力されている👉disabledを付与
      button.disabled = true;
    }
  }