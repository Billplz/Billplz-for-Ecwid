$(document).on("click", "#registeraccount", function (evt)
{
    /* your code goes here */
    var current_status_msg = $('#status_message').text();
    $('#status_message').text('Please wait while we are processing your request');
    var current_value_reg = $('#registeraccount').text();
    $('#registeraccount').attr("disabled", true);
    $('#registeraccount').html('Processing.....');

    var api_key = $('#api_secret_key').val();
    var x_signature = $('#x_signature').val();
    var collection_id = $('#collection_id').val();

    if (api_key === '') {
        window.alert('Please specify API Secret Key');
        $('#status_message').text(current_status_msg);
        $('#registeraccount').attr("disabled", false);
        $('#registeraccount').html(current_value_reg);
        return false;
    }

    if (x_signature === '') {
        window.alert('Please specify X Signature Key');
        $('#status_message').text(current_status_msg);
        $('#registeraccount').attr("disabled", false);
        $('#registeraccount').html(current_value_reg);
        return false;
    }

    $.ajax({
        type: 'POST',
        url: 'index.php?controller=register',
        datatype: "jsonp",
        timeout: 5000,
        data: {
            'api_key': api_key,
            'x_signature': x_signature,
            'collection_id': collection_id
        },
        success: function (result) {
            if (result.status === 'false') {
                $('#status_message').text(result.status_message);
                $('#registeraccount').attr("disabled", false);
                $('#registeraccount').html(current_value_reg);
                $('#api_login_id_display').hide(250);
                $('#transaction_key_display').hide(250);
                $('#md5_hash_display').hide(250);
                $('#transaction_type_display').hide(250);
                $('#endpoint_url_display').hide(250);
                return false;
            }

            $('#api_login_id_display').show(250);
            $('#transaction_key_display').show(250);
            $('#md5_hash_display').show(250);
            $('#transaction_type_display').show(250);
            $('#endpoint_url_display').show(250);

            $('#status_message').text(result.status_message);
            $('#api_login_id').text(result.api_login_id);
            $('#transaction_key').text(result.transaction_key);
            $('#md5_hash_value').text(result.md5_hash_value);
            $('#endpoint_url').text(result.enpoint_url);

            $('#api_secret_key').val('');
            $('#x_signature').val('');
            $('#collection_id').val('');

            $('#api_secret_key').attr('value', '');
            $('#x_signature').attr('value', '');
            $('#collection_id').attr('value', '');

            $('#registeraccount').attr("disabled", false);
            $('#registeraccount').html(current_value_reg);

        },

        error: function (xhr, status, error) {
            $('#status_message').text(xhr.responseText);

            $('#registeraccount').attr("disabled", false);
            $('#registeraccount').html(current_value_reg);
        }
    });

    return false;
});