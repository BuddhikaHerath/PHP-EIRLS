class Ajax_calls{


just_send(data){
    
}
 just_select(url,sending_way='POST',data={},text_info={have:'0',type:'null',name:'null'},callback,options={'item':'normal','load_class':'loading',successMsg:['Success','Your Query Success']}){
   var data_val
    $("#"+options['load_class']).show();
      if(options['item']== 'normal'){
        var $self = this;
            $.ajax({
                url:url,
                type:sending_way,
                data:data,
                success:function(data){
               
                   $("#"+options['load_class']).hide();
                   var came_data = JSON.parse(data);
                   var data = $self.ajaxError(came_data);
                   if(text_info['have']==1){
                    if(data['state']==1){
                        data_val = data['data_set'];
                        callback(data_val,text_info['name']);
                    
                        
                    }
                }

                  
                   
                   
                }
            });
        }
       
    
}

checkforempty(valeu,options={}){
    $("#loading").hide();
    if(options['dataType']==='array'){
        if(valeu.length>=options['size']){
            return 1;
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }

    }else if(options['dataType']=='string'){
        if(this.isEmptyOrSpaces(valeu)){
            return 1;
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }
    }else if(options['dataType']=='number'){
        if(!isNaN(valeu)){
            return 1;
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }
    }else if(options['dataType']=='email'){
        if(this.validateEmail(valeu)){
            return 1;
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }

    }else if(options['dataType']=='phone'){
        if(!isNaN(valeu)){
            if(valeu.length==10){
                return 1;
            }else{
                $("#error").empty();
                $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
                ${options['error'][1]}</div>`);
                $("#error_main").show('slow');
                setTimeout(()=>{
                    $("#error_main").hide('slow');
                },3000);
            }
        }

    }else if(options['dataType'] =='pwdval'){
        if(valeu.length>=6){
            if(valeu==options['other']){
                return 1;
            }else{
                $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
            }
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            password should contain at least 6 characters</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }
    }else if(options['dataType'] =='price'){
        
        if(valeu>options['minimum']){
             return 1;
            
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}  ${options['minimum']}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }



    }else if(options['dataType'] =='option'){
        
        if(valeu != 0){
          return 1;
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }



    }else if(options['dataType'] =='stock'){
        if(valeu >options['stock_enter_limit']){
          return 1;
        }else{
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>${options['error'][0]}</h4>
            ${options['error'][1]}</div>`);
            $("#error_main").show('slow');
            setTimeout(()=>{
                $("#error_main").hide('slow');
            },3000);
        }



    }else{
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>Unknown Error Please Contact services Provider</h4>
        Please Give us call 0711885002</div>`);
        $("#error_main").show('slow');
        setTimeout(()=>{
            $("#error_main").hide('slow');
        },3000);
    }
}


validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

 isEmptyOrSpaces(str){
    return str === null || str.trim().length>0;
}


ajaxError(came_data){
    
    if(came_data['state']==1){
        $('form').find("input[type=text], textarea,input[type=number]").val("");
        $("#success").empty();
        $("#success").html(`<h4><i class="fa fa-smile-o"> </i>   ${ came_data['message_header']}</h4>
          ${came_data['message_body']}</div>`);
        $("#success_main").show('slow');
        setTimeout(()=>{
            $("#success_main").hide('slow');
        },3000);
       }else if(came_data['state']==500){
        $("#error").empty();
        $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${ came_data['message_header']}</h4>
        ${came_data['message_body']}</div>`);
        $("#error_main").show('slow');
        setTimeout(()=>{
            $("#error_main").hide('slow');
        },3000);
       }else if(came_data['state']==499){
        $("#error").empty();
        $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${ came_data['message_header']}</h4>
        ${came_data['message_body']}</div>`);
        $("#error_main").show('slow');
        setTimeout(()=>{
            $("#error_main").hide('slow');
        },3000);
       }else if(came_data['state']==999){
         var send_back = {data_set:came_data['data_set'],state:1};//making data set send back
         return send_back; //returning Data Back
       }else{
        $("#error").empty();
        $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${ came_data['message_header']}</h4>
        ${came_data['message_body']}</div>`);
        $("#error_main").show('slow');
        setTimeout(()=>{
            $("#error_main").hide('slow');
        },3000);
       }
      
 }

}


