function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 10);
        n += randomNumber.toString();
    }

    return n;
}

var finalSequence = randomNumber(9);

document.write('<INPUT TYPE=TEXT NAME="inv_num" VALUE='+finalSequence +' MAXLENGTH=16 SIZE=16>');