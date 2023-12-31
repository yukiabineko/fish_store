window.addEventListener('load',()=>{
    let replayButton = null;     //=>返信ボタン


    /**
     * 問い合わせリスト
     */
    document.querySelectorAll('.contact-list').forEach( contact =>{
        contact.addEventListener('mousedown', event =>{
            let newPosition = 0;
            //問い合わせ内容コンテンツ
            let textBody= contact.children[0].children[1];
            let buttonText =  contact.children[0].children[0].children[1];

            let admin = contact.children[0].children[0].children[0].children[1];
            
            //返信ボタン（管理者のみ)
            if( admin ){
                replayButton 
                = contact.children[0].children[0].children[0].children[1].children[1];
            }
            
            /**
             * 管理者ページの場合
             */
            if( replayButton ){
                const width = replayButton.clientWidth;
                const height = replayButton.clientHeight;
                const rect = replayButton.getBoundingClientRect();
                const buttonX = rect.left;
                const buttonY = rect.top;
                let x = event.clientX;
                let y = event.clientY;
                if( ! ( x >= buttonX && x <= buttonX + width && y >= buttonY && y<= buttonY + height)){
                    if( textBody.dataset.status == 'off' ){
                        textBody.classList.add('body-open');
                        textBody.dataset.status = "on";
                        buttonText.textContent = "閉じる";
        
                    }
                    else{
                        textBody.classList.remove('body-open');
                        textBody.dataset.status = "off";
                        buttonText.textContent = "内容を見る";
                    }
                }
            }
            /**
             * 管理者でない場合
             */
            else{
                if( textBody.dataset.status == 'off' ){
                    textBody.classList.add('body-open');
                    textBody.dataset.status = "on";
                    buttonText.textContent = "閉じる";
    
                }
                else{
                    textBody.classList.remove('body-open');
                    textBody.dataset.status = "off";
                    buttonText.textContent = "内容を見る";
                }
            }
          /** 管理者、一般ユーザー分岐終了 */
            
        });
    });
    /**
     * 返信ボタン押下処理
     */
    document.querySelectorAll('.replay').forEach(btn =>{
       btn.addEventListener('click', event=>{
        //押下さらたボタンの位置
        const buttonY = event.clientY;
        console.log('ボタン:' +buttonY);
        console.log('全体:'+ window.innerHeight);

        //ページタイトルヘッダーのy軸位置
        let titleContent = document.querySelector('.page-title');
        const titleY = titleContent.getBoundingClientRect().top;
        const titleHeight = titleContent.clientHeight;
        const titlePosition = titleY + titleHeight;
        console.log('タイトル位置:' + titleY);


        /**
         * ajax関連
         */
        const contactId = btn.dataset.contact;
        let url 
            = location.protocol + "//" + location.host + "/fish/public/admin/contacts/" + contactId;

        fetch(url).then((respose)=>{
           return respose.json();
        }).then((json)=>{
           let modal =  document.querySelector('.modal');
           const height = modal.clientHeight;
           console.log('高さ:' + height)

           /*各種取得したデータを格納*/
           document.querySelector('.modal-user-name').textContent = json.name;
           document.querySelector('.modal-contact-title').textContent = json.title;
           document.querySelector('.modal-contact-context').textContent = json.context;
           document.querySelector('.replay-email').value = json.email;
           document.querySelector('.contact_id').value = json.id;


           document.querySelector('.back-ground-layer').classList.add('back-ground-layer-open');
           //modal.classList.add('modal-open');
           
           if(titlePosition > 10){
              newPosition = titlePosition + buttonY;
           }
           else{
              newPosition = buttonY + height / 2.2;
           }
          
           console.log('新しい位置:' + newPosition);
           modal.style.top =  newPosition + "px";                        //=>モーダルの位置
           //document.documentElement.scrollTop = - window.screenY + "px";   //=>スクロールの位置
           
       
           

        });
        /**fetch finish */
       });
       /** button push finish */
    });
    /**
     * モーダルのバックレイヤーをクリックした場合モーダル閉じる
     */
    document.querySelector('.back-ground-layer').addEventListener('click', ()=>{
       closeModal();
    });
});
/**
 * モーダルを閉じる
 */
const closeModal = ()=>{
    document.querySelector('.modal-input').value = "";           //=>返信タイトルのリセット
    document.querySelector('.modal-textarea').value = "";        //=>返信本文のリセット
    document.querySelector('.back-ground-layer').classList.remove('back-ground-layer-open');
    document.querySelector('.modal').style.top = - window.innerHeight + "px";
}
/*
const invalidButton = () =>{
    document.querySelectorAll('.replay').forEach( btn =>{
        btn.disabled = true;
    });
}
*/

