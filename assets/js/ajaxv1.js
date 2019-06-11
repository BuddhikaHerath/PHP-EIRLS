class App {
  AjaxCaller(data) {
    var loader = "";
    if (typeof data["loader"] !== "undefined") {
      loader = $("#" + data["loader"]);
    } else {
      loader = $("#loading");
    }
    loader.show();
    if (
      typeof data["url"] !== "undefined" &&
      typeof data["type"] !== "undefined"
    ) {
      var $self = this;
      $.ajax({
        url: data["url"],
        type: data["type"],
        data: data["data"],
        success: function(response) {
          loader.hide();
          console.log(response);
          var response = JSON.parse(response);
          var filtered_response = $self.ajaxError(response);

          if (
            (typeof data["callback"] !== "undefined" &&
              response["state"] == 999) ||
            response["active"] == 1
          ) {
            data["callback"](filtered_response, data["element_name"]);
          }
        }
      });
    } else {
      console.log("Please Re Check The Objects");
    }
  }

  ///Error Validation
  ajaxError(came_data) {
    if (came_data["state"] == 1) {
      $("form")
        .find(
          "input[type=text],input[type=password], textarea,input[type=number]"
        )
        .val("");
      $("#success").empty();
      $("#success").html(`<h4><i class="fa fa-smile-o"> </i>   ${
        came_data["message_header"]
      }</h4>
          ${came_data["message_body"]}</div>`);
      $("#success_main").show("slow");
      setTimeout(() => {
        $("#success_main").hide("slow");
      }, 3000);
      $("form")
        .closest("form")
        .find("input['type=text'],input['type=email'],input['type=number']")
        .val("");
    } else if (came_data["state"] == 500) {
      $("#error").empty();
      $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${
        came_data["message_header"]
      }</h4>
        ${came_data["message_body"]}</div>`);
      $("#error_main").show("slow");
      setTimeout(() => {
        $("#error_main").hide("slow");
      }, 3000);
    } else if (came_data["state"] == 499) {
      $("#error").empty();
      $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${
        came_data["message_header"]
      }</h4>
        ${came_data["message_body"]}</div>`);
      $("#error_main").show("slow");
      setTimeout(() => {
        $("#error_main").hide("slow");
      }, 3000);
    } else if (came_data["state"] == 999) {
      return came_data; //returning Data Back
    } else if (came_data["state"] == 498) {
      $("#error").empty();
      $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${
        came_data["message_header"]
      }</h4>
        ${came_data["message_body"]}</div>`);
      $("#error_main").show("slow");
      setTimeout(() => {
        $("#error_main").hide("slow");
      }, 3000);
    } else {
      $("#error").empty();
      $("#error").html(`<h4><i class="fa fa-frown-o"> </i>    ${
        came_data["message_header"]
      }</h4>
        ${came_data["message_body"]}</div>`);
      $("#error_main").show("slow");
      setTimeout(() => {
        $("#error_main").hide("slow");
      }, 3000);
    }
  }

  //validation
  checkforempty(valeu, options = {}) {
    $("#loading").hide();
    if (options["dataType"] === "array") {
      if (valeu.length >= options["size"]) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "string") {
      if (this.isEmptyOrSpaces(valeu)) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "number") {
      if (!isNaN(valeu)) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "email") {
      if (this.validateEmail(valeu)) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "phone") {
      if (!isNaN(valeu)) {
        if (valeu.length == 10) {
          return 1;
        } else {
          $("#error").empty();
          $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
            options["error"][0]
          }</h4>
                ${options["error"][1]}</div>`);
          $("#error_main").show("slow");
          setTimeout(() => {
            $("#error_main").hide("slow");
          }, 3000);
        }
      }
    } else if (options["dataType"] == "pwdval") {
      if (valeu.length >= 6) {
        if (valeu == options["other"]) {
          return 1;
        } else {
          $("#error").empty();
          $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
            options["error"][0]
          }</h4>
            ${options["error"][1]}</div>`);
          $("#error_main").show("slow");
          setTimeout(() => {
            $("#error_main").hide("slow");
          }, 3000);
        }
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            password should contain at least 6 characters</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "price") {
      if (valeu > options["minimum"]) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}  ${options["minimum"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "option") {
      if (valeu != 0) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (options["dataType"] == "stock") {
      if (valeu > options["stock_enter_limit"]) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          options["error"][0]
        }</h4>
            ${options["error"][1]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else {
      $("#error").empty();
      $("#error")
        .html(`<h4><i class="icon fa fa-ban"></i>Unknown Error Please Contact services Provider</h4>
        Please Give us call 0711885002</div>`);
      $("#error_main").show("slow");
      setTimeout(() => {
        $("#error_main").hide("slow");
      }, 3000);
    }
  }

  validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  isEmptyOrSpaces(str) {
    return str === null || str.trim().length > 0;
  }

  //validation
  checkforempty2(data) {
    $("#loading").hide();
    if (data["type"] === "array") {
      if (data["value"].length >= data["minimum"]) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "text") {
      if (this.isEmptyOrSpaces(data["value"])) {
        if (typeof data["minimum"] !== "undefined") {
          if (data["value"].length == data["minimum"]) {
            return 1;
          } else {
            $("#error").empty();
            $("#error").html(`<h4><i class="icon fa fa-ban"></i>Length </h4>
            Length is not valid</div>`);
            $("#error_main").show("slow");
            setTimeout(() => {
              $("#error_main").hide("slow");
            }, 3000);
          }
        } else {
          return 1;
        }
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "number") {
      if (!isNaN(data["value"])) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "email") {
      if (this.validateEmail(data["value"])) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "phone") {
      if (!isNaN(data["value"])) {
        if (data["value"].length == 10) {
          return 1;
        } else {
          $("#error").empty();
          $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
            data["header"]
          }</h4>
                ${data["body"]}</div>`);
          $("#error_main").show("slow");
          setTimeout(() => {
            $("#error_main").hide("slow");
          }, 3000);
        }
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>Phone Number</h4>
            Enter Valid Phone number</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "password") {
      if (data["value"].length >= 6) {
        if (data["value"] == data["confirm"]) {
          return 1;
        } else {
          $("#error").empty();
          $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
            data["header"]
          }</h4>
            ${data["body"]}</div>`);
          $("#error_main").show("slow");
          setTimeout(() => {
            $("#error_main").hide("slow");
          }, 3000);
        }
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>Password Length</h4>
            password should contain at least 6 characters</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "price") {
      if (data["value"] > data["minimum"]) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}  ${data["minimum"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "option") {
      if (data["value"] != 0) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else if (data["type"] == "stock") {
      if (data["value"] > data["minimum"]) {
        return 1;
      } else {
        $("#error").empty();
        $("#error").html(`<h4><i class="icon fa fa-ban"></i>${
          data["header"]
        }</h4>
            ${data["body"]}</div>`);
        $("#error_main").show("slow");
        setTimeout(() => {
          $("#error_main").hide("slow");
        }, 3000);
      }
    } else {
      $("#error").empty();
      $("#error")
        .html(`<h4><i class="icon fa fa-ban"></i>Unknown Error Please Contact services Provider</h4>
        Please Give us call 0711885002</div>`);
      $("#error_main").show("slow");
      setTimeout(() => {
        $("#error_main").hide("slow");
      }, 3000);
    }
  }
}
