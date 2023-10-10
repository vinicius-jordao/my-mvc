defaultModal = null;

function listernerCloseModal() {
	$("div#default-modal").on("hidden.bs.modal", function () {
		$(this).find("div.modal-content").html('<div class="spinner-border text-primary" role="status"></div>');
	});
}
listernerCloseModal();

function closeModal() {
	defaultModal.hide();
}

function openModal(size, url = false) {
	defaultModal = new bootstrap.Modal("#default-modal");
	$("div#default-modal div.modal-dialog").removeClass(".modal-xl").removeClass(".modal-lg").removeClass(".modal-md").removeClass(".modal-sm");
	$("div#default-modal div.modal-dialog").addClass("modal-" + size);
	if(url) {
		$.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            success: function(response) {
                console.log(response);
                if(response.modal) {
                    $("div#default-modal div.modal-content").html(response.modal);
                }
            },
            error: function(response) {
                console.log(response.responseText);
            },
        });
	}
	defaultModal.show();
}

function getAddressByZip(zip) {
	zip = zip.replace(/\D/g, "");
	if (zip != "") {
		var validate = /^[0-9]{8}$/;
		if (validate.test(zip)) {
			$("input[name=zip], input[name=address], input[name=district], input[name=city], select[name=state]").attr("disabled", "disabled");
			$.getJSON("//viacep.com.br/ws/" + zip + "/json/?callback=?", function (data) {
				if (!("erro" in data)) {
					$("input[name=address]").val(data.logradouro);
					$("input[name=district]").val(data.bairro);
					$("input[name=city]").val(data.localidade);
					$("select[name=state]").val(data.uf);
					$("input[name=number]").focus();
				} else {
					console.log("CEP não encontrado.");
				}
				$("input[name=zip], input[name=address], input[name=district], input[name=city], select[name=state]").removeAttr("disabled");
			});
		} else {
			console.log("Formato de CEP inválido.");
		}
	}
}

function copyContent(element) {
	element = $(element);
	let url = element.attr("data-url");
	let html = element.html();
	let input = $('<input style="position:absolute;left:-8888vw;top:-8888vh" value="' + url + '">');
	element.append(input);
	input.select();
	document.execCommand("copy");
	element.html("Copiado!");
	setTimeout(() => {
		element.html(html);
	}, 2000);
}

function toggleUploadImage(element, event) {
	event.preventDefault();
	let container = $($(element).parents('.image-selector')[0]);
	container.find('input').click();
	container.find('input').change(function() {
		loadPreviewImage(element);
	});
}

function loadPreviewImage(element) {
	let container = $($(element).parents('.image-selector')[0]);
	let input = container.find('input')[0];
	const file = input.files;
	let url = URL.createObjectURL(file[0])
	let style = container.find('div.output').attr('style');
	container.find('div.output').attr('style', 'background: url(' + url + ') no-repeat center/cover !important;' + style);
}
