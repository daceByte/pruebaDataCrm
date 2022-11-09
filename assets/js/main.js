function getDataAjax() {
  $(".divTable").html('<div class="preloader"></div>');
  $.ajax({
    type: "POST",
    url: window.location,
    data: "query=true",
    success: function (response) {
      if (response != null) {
        response = JSON.parse(response);
        if (response.success != "false") {
          var stringTable =
            '<table class="table"><thead><tr><th scope="col">ID</th><th scope="col">No. Contacto</th><th scope="col">Apellido</th><th scope="col">Tiempo de Creacion</th></tr></thead><tbody>';
          response.forEach((element) => {
            stringTable +=
              "<tr><th>" +
              element.id +
              "</th><th>" +
              element.contact_no +
              "</th><th>" +
              element.lastname +
              "</th><th>" +
              element.createdtime +
              "</th></tr>";
          });
          stringTable += "</tbody></table>";
          $(".divTable").html(stringTable);
        } else {
          $(".divTable").html('<p class="textTable">Error interno 500</p>');
        }
      }
    },
  });
}
