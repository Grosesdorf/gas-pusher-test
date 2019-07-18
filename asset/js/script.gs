function sendToPusher() {
    var ss = SpreadsheetApp.getActiveSpreadsheet();
    var sheet = ss.getSheetByName("CurrentTemperature");
    var value = sheet.getRange("B1").getValue();

    var data = {"value": value};
    var payload = {"name":"current-temp","channels":["current-temp-channel"],"data":JSON.stringify(data)};
    var app_id = '823813';
    var key = '11b036156bca156ca915';
    var secret = 'dba6b4b046fe148fc738';
    var auth_timestamp = Math.floor((new Date().getTime()/1000)).toString();
    var auth_version = '1.0';
    var body_md5 = Utilities.computeDigest(Utilities.DigestAlgorithm.MD5, JSON.stringify(payload), Utilities.Charset.US_ASCII).map(function(chr){return (chr+256).toString(16).slice(-2)}).join('');
    var string_to_sign =
      "POST\n/apps/" + app_id +
        "/events\nauth_key=" + key +
          "&auth_timestamp=" + auth_timestamp +
            "&auth_version=" + auth_version +
              "&body_md5=" + body_md5;

    var digest256 = Utilities.computeHmacSha256Signature(string_to_sign, secret).map(function(chr){return (chr+256).toString(16).slice(-2)}).join('');

    var headers = {
      "Accept": "application/json",
      "contentType": "application/json",
    };

    var options = {
    headers : headers,
    method : "POST",
    payload : JSON.stringify(payload),
    contentType : 'application/json',
    muteHttpExceptions : true,
  };

    var url = "https://api-eu.pusher.com/apps/823813/events?body_md5="+body_md5+"&auth_version="+auth_version+"&auth_key="+key+"&auth_timestamp="+auth_timestamp+"&auth_signature="+digest256+"&";

    var response = UrlFetchApp.fetch(url, options);

    var responseCode = response.getResponseCode();
    var responseBody = response.getContentText();

    Logger.log(responseCode);
    Logger.log(responseBody);
}
