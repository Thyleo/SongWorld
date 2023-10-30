        
        //Code JS pour changer le texte sur le bouton
        var btn = document.getElementsByClassName('btn')[0];
        var txtPosition = 0;
        btn.addEventListener('click', function(){
            changeText();
          });

          var btnTxt = [
            'Clique encore',
            'Allez plus vite',
            'Tu es plus curieux ?',
            'Dépêche !!',
            'Arrête maintenant !!',
            'Bon une dernière fois',
            'Coucou visiteur @thierry'
          ];
          
          function changeText(){
            if(txtPosition !== btnTxt.length){
              btn.innerHTML = btnTxt[txtPosition];
              txtPosition += 1;
            }
          }
