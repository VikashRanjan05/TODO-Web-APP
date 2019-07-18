function AppController() {
  this.model = new AppModel();
  this.model.showTodo();
  this.toggle = new TodoItem();

  this.addTodo = function(caption, isCompleted) {
    this.model.addTodo(caption, isCompleted);
    this.pre_render();
  };

  this.attachEventHandlers = function() {
    var self = this;
    $("#input-form").submit(function(event) {
      event.preventDefault();
      var inputDOM = $("#input");
      var input = inputDOM.val();
      inputDOM.val("");

      if (input) {
        self.addTodo(input, 0);
        self.pre_render();
      }
    });

    var inx = 0;
    $("#done").click(function() {
      self.model.showCompletedTodo();
      self.pre_render();
    });

    $("#undone").click(function() {
      self.model.showIncompletedTodo();
      self.pre_render();
    });

    $("#clear_filter").click(function() {
      self.model.showTodo();
      self.pre_render();
    });
  };

  this.render = function() {
    var self = this;
    var list = $("#list");
    list.html("");

    for (var i in this.model.todoCollection) {
      var todoItem = this.model.todoCollection[i];

      var index = this.model.todoCollection[i].id;
      var li = $("<li></li>");
      var tododata = $("<span></span>", { class: "litext" }).text(
        todoItem.caption
      );

      var checkstatus = $("<input />", {
        type: "checkbox",
        class: "licheck"
      });

      checkstatus.click(
        function(id, i) {
          self.model.toggle(id, i);
          self.pre_render();
        }.bind(null, index, i)
      );

      if (todoItem.isCompleted == 1) {
        checkstatus.prop("checked", true);
        tododata.css({ "text-decoration": "line-through" });
      } else {
        checkstatus.prop("checked", false);
        tododata.css({ "text-decoration": "none" });
      }

      var deleteBtn = $("<input />", {
        type: "button",
        value: "x",
        class: "libutton"
      });

      deleteBtn.click(
        function(id, i) {
          self.model.removeTodo(id, i);
          self.pre_render();
        }.bind(null, index, i)
      );

      li.append("<div>");
      li.append(checkstatus);
      li.append("</div>");
      li.append("<div>");
      li.append(tododata);
      li.append("</div>");
      li.append("<div >");
      li.append(deleteBtn);
      li.append("</div>");

      $("#list").append(li);
      tododata.dblclick(
        function(index, li, todoCollection) {
          var previous = todoCollection[index]["caption"];
          li.html("");
          var updateinput = $("<input />", {
            type: "text",
            value: previous,
            class: "litext"
          });
          li.append(updateinput);
          var update = $("<input />", {
            type: "button",
            value: "O",
            class: "libutton"
          });
          li.append(update);
          update.click(
            function(i) {
              var id = todoCollection[index]["id"];
              var new_caption = updateinput.val();
              self.model.updateTodo(id, new_caption, i);
              self.pre_render();
            }.bind(null, index)
          );
        }.bind(null, i, li, this.model.todoCollection)
      );
    }
  };

  this.attachEventHandlers();

  this.pre_render = function() {
    var self = this;
    $(document).ajaxStop(function() {
      self.render();
    });
  };
}
