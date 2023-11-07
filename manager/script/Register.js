
function previewImages() {
  const fileInput = document.getElementById('fileInput');
  const imagePreviews = document.getElementById('imagePreviews');
 
 

  for (let i = 0; i < fileInput.files.length; i++) {
      const reader = new FileReader();
      const img = document.createElement('img');
      const space = document.createTextNode(' '); // 半角スペースのテキストノードを作成
      const deleteButton = document.createElement('button');
      deleteButton.innerHTML = '削除';
      deleteButton.className = 'delete-button';
      deleteButton.addEventListener('click', function() {
          // 削除ボタンがクリックされたときの処理
          imagePreviews.removeChild(imageContainer);
      });
     
      reader.onload = function (e) {
          img.src = e.target.result;
      };
     
      img.style.maxWidth = '100px';
      img.style.maxHeight = '100px';
      img.style.height='65px';
      img.style.width='65px';

      reader.readAsDataURL(fileInput.files[i]);

      const imageContainer = document.createElement('span');
      imageContainer.className = 'image-container';
      imageContainer.appendChild(img);
      imageContainer.appendChild(deleteButton);
      imagePreviews.appendChild(imageContainer);
      imageContainer.appendChild(space);
  }
}