    function responseTicket() {
         $.ajax({
         type: 'POST',
         url: '/admin/admin_func.php',
         
         beforeSend: function() {
                 },	
         data: {
         type: "responseTicket",
            ticket_id: $("#tid").html(),
            ticket_mess: $("#tmess").val()
         },
         success: function(data) {
             var obj = jQuery.parseJSON(data);
             if (obj.success == "success") {
                 $("#ticket-block").load("tickets.php #ticket-block");
                 toastr['success']('Тикет успешно обновлен')
             }else{
                 toastr['error'](obj.error)
         
           
                                             }
                                         }   
         });
         }  
    function resetWager() {
         $.ajax({
         type: 'POST',
         url: '/admin/admin_func.php',
         
         beforeSend: function() {
                 },	
         data: {
         type: "resetWager",
            user_id_selected: $("#userid").html()
         },
         success: function(data) {
             var obj = jQuery.parseJSON(data);
             if (obj.success == "success") {
                 $('#wager_stat').val('0');
                 toastr['success']('Вагер обнулен')
             }else{
                 toastr['error'](obj.error)
         
           
                                             }
                                         }   
         });
         }


   function generateRandomCode() {
                        const randomCode = Math.random().toString(36).substring(2, 8);
                            const inputElement = document.getElementById("promoname");
                         inputElement.value = randomCode;
                         toastr['success']('Сгенерированно!') 
   }
   function generateRandomCode2() {
                                const randomCode = Math.random().toString(36).substring(2, 8);
                                const inputElement = document.getElementById("giftname");
                                inputElement.value = randomCode;
                                toastr['success']('Сгенерированно!')
       
   } 
     function del_promo(id_promo) {
         $.ajax({
         type: 'POST',
         url: '/admin/admin_func.php',
         beforeSend: function() {
         
                 },	
         data: {
         type: "del_promo",
            
            id_promo: id_promo                                                                     },
                                         success: function(data) {
                                             var obj = jQuery.parseJSON(data);
                                             if (obj.success == "success") {
                                 toastr['success']('Промокод удален!')               
         
                 $("#promo-table").load("promo.php #promo-table");
                                             
                                                               
                                             }else{
                 toastr['error'](obj.error)
                                             }
                                         }   
         });
         }
    
    function create() {
         $.ajax({
         type: 'POST',
         url: '/admin/admin_func.php',
         
         beforeSend: function() {
         $("#succes_creat").hide(); 
         $("#error_creat").hide();   
                 },	
         data: {
         type: "creatpromo",
            promoname: $("#promoname").val(),                                        
            promosum: $("#promosum").val(),
            promoact: $("#promoact").val()                                                                      
         },
         success: function(data) {
             var obj = jQuery.parseJSON(data);
             if (obj.success == "success") {
                 toastr['success']('Промокод создан!')                
                 $("#promo-table").load("promo.php #promo-table");
             }else{
                 toastr['error'](obj.error)
         
           
                                             }
                                         }   
         });
         }

    function saves() {
           $.ajax({
             type: 'POST',
             url: '/admin/admin_func.php',
         beforeSend: function() {
               toastr['info']("Сохраняем")
             },  
             data: {
               type: "save_edit",
               sitename: $("#sitename").val(), 
               sitegroup: $("#sitegroup").val(), 
               sitedomen: $("#sitedomen").val(), 
               sitesupport: $("#sitesupport").val(),                                     
               dep_withdraw: $("#dep_withdraw").val(), 
               min_withdraw_sum: $("#min_withdraw_sum").val(), 
               id_vk: $("#id_vk").val(), 
               token_vk: $("#token_vk").val(), 
               min_deposit: $("#min_deposit").val(), 
               coefbon1wag: $("#coefbonwag").val(), 
               coefdep1wag: $("#coefdepwag").val(), 
               coefpromwag: $("#coefpromwag").val(),
               fkid: $("#fkid").val(),
               fks1: $("#fks1").val(),
               fks2: $("#fks2").val(),
               lpid: $("#lpid").val(),
               lps1: $("#lps1").val(),
               lps2: $("#lps2").val(),               
               vkgoupid: $("#vkgoupid").val(),
               vkgrouptoken: $("#vkgrouptoken").val(),  
               tehworks: $("#tehworks").val(),
               grecaptchakeys: $("#grecaptchakeys").val(), 
               minbet: $("#minbet").val(), 
               maxbet: $("#maxbet").val(),
               daily_min: $("#daily_min").val(),
               daily_max: $("#daily_max").val(),
               vkgroupsize: $("#vkgroupsize").val(),
               vkrepostsize: $("#vkrepostsize").val(),
               withdraw_min_sbp: $("#withdraw_min_sbp").val(),
               withdraw_min_fkwallet: $("#withdraw_min_fkwallet").val(),
               wager_for_bets: $("#wager_for_bets").val(),
               repostUrl: $("#repostUrl").val(),
               tgsize: $("#tgsize").val(),
               max_mines: $("#max_mines").val(),
               refrandprize: $("#refrandprize").val()
             },
        
             success: function(data) {
               var obj = jQuery.parseJSON(data);
               if (obj.success == "success") {
                   toastr['success']("Данные изменены!")     
               }else{
                   toastr['error'](obj.error)
               }
             }   
           });
         }
         
        var lastResFind = ""; // последний удачный результат
         var copyPage = ""; // копия страницы в исходном виде
         
         function trimStr(s) {
             s = s.replace(/^\s+/g, '');
             return s.replace(/\s+$/g, '');
         }
         

         
         function validateInput(event) {
                 const inputElement = event.target;
                 const inputValue = inputElement.value;
         
                 // Проверяем, содержит ли введенное значение только буквы и пробелы
                 if (/[^a-zA-Zа-яА-Я\s]/.test(inputValue)) {
                     // Если введены числа, удаляем их из значения
                     inputElement.value = inputValue.replace(/[^a-zA-Zа-яА-Я\s]/g, '');
                 }
             }
         
         document.addEventListener('DOMContentLoaded', function() {
             var inputElement = document.getElementById('text-to-find'); // Замените 'searchInput' на id вашего текстового поля
         
             inputElement.addEventListener('keydown', function(event) {
                 if (event.key === 'Enter') {
                     findOnPage('text-to-find'); // Замените 'text-to-find' на ваш текст для поиска
                     event.preventDefault();
                 }
             });
         });
         
      function save_user_edit() {
                                  $.ajax({
                                      type: "POST",
                                      url: "/admin/admin_func.php",
                              
                              beforeSend: function() {
                                      $("#status").hide();	
                                  },	
                                  data: {
                                      type: "saveInfo",
                                      id: $("#userid").html(),
                                      userbal: $("#userbal").val(),
                                      ban_user: $("#ban_user").val(),
                                      role_user: $("#role_user").val()
                                  },
                                  success: function(data) {
                                    var obj = jQuery.parseJSON(data);
                                    if (obj.success == "success") {
                                      $("#status").show(); 
                                      $('#ball').val(obj.bal);
                                      toastr['success']("Данные изменены")            
                                              }else{
                                      $("#status").show();                               
                                      toastr['error'](obj.error)
                                      }
                                  }   
                              });
                              }
                              function select(id) {
                                  $.ajax({
                                      type: "POST",
                                      url: "/admin/admin_func.php",
                              beforeSend: function() {
                                  },	
                                  data: {
                                      type: "getInfo",
                                      id: id                                                                      
                                  },
                                  success: function(data) {
                                    var obj = jQuery.parseJSON(data);
                                    if (obj.success == "success") {
                                      $("#userid").html(obj.id);      
                                      $("#username").val(obj.log);
                                      $("#userpass").val(obj.pass);
                                      $("#userbal").val(obj.bal);                         
                                              }else{
                                      toastr['error'](obj.error)
                                      }
                                  }   
                              });
                              }
                
                function ban_adm(hashed) {
                                  $.ajax({
                                      type: "POST",
                                      url: "/admin/admin_func.php",
                              beforeSend: function() {
                                  },	
                                  data: {
                                      type: "ban",
                                      hashuser: hashed                                                                      
                                  },
                                  success: function(data) {
                                    var obj = jQuery.parseJSON(data);
                                    if (obj.success == "success") {
                                      toastr['info']('Пользователь заблокирован')     
                                      $("#multicheck-table").load("userInfo.php #multicheck-table");
                                              }else{
                                      toastr['error'](obj.error)
                                      }
                                  }   
                              });
                              }
                              
                              function unban_adm(hashed) {
                                  $.ajax({
                                      type: "POST",
                                      url: "/admin/admin_func.php",
                              beforeSend: function() {
                                  },	
                                  data: {
                                      type: "unban",
                                      hashuser: hashed                                                                      
                                  },
                                  success: function(data) {
                                    var obj = jQuery.parseJSON(data);
                                    if (obj.success == "success") {
                                      $("#multicheck-table").load("userInfo.php #multicheck-table");                       
                                      toastr['info']('Пользователь разблокирован')                               
                                              }else{
                                      toastr['error'](obj.error)
                                      }
                                  }   
                              });
                              }
                              
         function withdraw_adm(status) {
            $.ajax({
                type: "POST",
                url: "/admin/admin_func.php",
                
                beforeSend: function() {
                  }, 
                
                data: {
                    type: "editstatus",
                    id_edit: $("#editidw").html(),
                    id_user: $("#useridw").html(),
                    id_sum: $("#usersumw").html(),
                    status: status
                },
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.success == "success") {
                        toastr['success']('Статус выплаты изменен')            
                        $("#close-mod").click();
                        $("#withdraws-tbl").load("withs.php #withdraws-tbl");
                    } else {
                    toastr['error'](obj.error)
         
                    }
                }
            });
         }
 
 
      function clearGames() {
         $.ajax({
         type: 'POST',
         url: '/admin/admin_func.php',
         beforeSend: function() {
         $('#cl1').html('loading..');
                 },	
         data: {
         type: "sqlclear_games",
                                                                                 },
                                         success: function(data) {
                                             var obj = jQuery.parseJSON(data);
                                             if (obj.success == "success") {
                                 toastr['success']('Успешно')             
                                 $('#cl1').html('Очистить все игры');            
                                                               
                                             }else{
                 toastr['error'](obj.error)
                 $('#cl1').html('Очистить все игры'); 
                                             }
                                         }   
         });
         }         
         
         
      function clearChat() {
         $.ajax({
         type: 'POST',
         url: '/admin/admin_func.php',
         beforeSend: function() {
         $('#cl2').html('loading..');
                 },	
         data: {
         type: "sqlclear_chat",
                                                                                 },
                                         success: function(data) {
                                             var obj = jQuery.parseJSON(data);
                                             if (obj.success == "success") {
                                 toastr['success']('Успешно')           
                                 $('#cl2').html('Очистить чат');            
                                                               
                                             }else{
                 toastr['error'](obj.error)
                 $('#cl2').html('Очистить чат');                             }
                                         }   
         });
         }           
         
         