/* 
    See associated requirement file. I was able to get most of the formatting done to solve for the examples but I'm
    unsure whether they would apply to the more general example. In particular there is a tag line on the body I don't quite
    understand. I think it's 1 "=" followed by 4 or 5 standard characters. I just don't know the standard and I'm going cross-eyed
    reading the RFC. This is more or less throw away code.
*/

function pgpStringFormat(pgpStr)
{
    // These are the various types of PGP messages to expect
    var formats = "(MESSAGE|PRIVATE KEY BLOCK|PUBLIC KEY BLOCK)";

    // Get true header portion that looks like "-----BEGIN PGP PRIVATE KEY BLOCK-----"
    var regExHeader = "^-{5}BEGIN PGP " + formats + "-{5} ";

    // This is the footer which includes the tag line of the message in addition to the footer like "-----END PGP PRIVATE KEY BLOCK-----"
    var regExFooter = "(\\s=[\\s\\S]*)(-{5}" +"END PGP \\1-{5})$";

    // This is the optional version and comment section with the bulk of the message
    var regExBody = "(Version: [\\s\\S]*?){0,1}(Comment: [\\s\\S]*?){0,1}(\\S{60}\\s[\\s\\S]*)";
    

    var regExStr = regExHeader + regExBody + regExFooter;
    var regEx = new RegExp(regExStr);
    if (!regEx.test(pgpStr))
    {
        throw "Incorrect PGP format";
        return "false";
    }

    var pgpArry = regEx.exec(pgpStr);

    // The header line
    var output = "-----BEGIN PGP " + pgpArry[1].trim() + "-----\r\n";
    
    // Optional line either Version or Comment
    if (pgpArry.length > 3)
        output += pgpArry[2].trim() + "\r\n";
    // Optional line either Version or Comment
    if (pgpArry.length > 4)
        output += pgpArry[3].trim() + "\r\n";

    output += "\r\n";

    // Remove all white space. We are putting the white space where it belongs
    pgpArry[pgpArry.length-3] = pgpArry[pgpArry.length-3].replace(/\s/g,'');
    
    // Add a linefeed carriage return after every 60 characters
    for (var i = 0; i < pgpArry[pgpArry.length-3].length; i++)
    {
        output += pgpArry[pgpArry.length-3][i];
        if ((i+1)%60 == 0)
            output += "\r\n";
    }
    
    // Ensure only one extra space before the final line of the cypher
    if (output.slice(output.length-6,output.length) != "\r\n")
        output += "\r\n";
    output += pgpArry[pgpArry.length-2].trim() + "\r\n";
    
    // Extra space and the footer
    output += "\r\n";
    output += "-----END PGP " + pgpArry[1].trim() + "-----";
    
    // Allow conditional opportunity as per the specs
    if (pgpArry[1].trim() == "MESSAGE")
    {
        var x = 0;
    }
    else if (pgpArry[1].trim() == "PRIVATE KEY BLOCK")
    {
        var y = 0;
    }
    else if (pgpArry[1].trim() == "PUBLIC KEY BLOCK")
    {
        var z = 0;
    }
    else 
        throw "Not a recognized message type";
    
    return output;
}


var pgpStringExample1 = "-----BEGIN PGP MESSAGE----- Version: OpenPGP.js VERSION Comment: http://openpgpjs.org  wYwDD2MACDvE17QBA/9IfXad2q7wf1wd+m6qlfVkCxphnMkpNb+r44f3YHcQ kM0XQwvQPZL8tJsqHCIEBmkeMAkVfMMJSN6sN8C+vw7Qy049tWD4xB3JterH PeGT7U4JETUEP6/t8dVGN7rjBz9M7RETCCYBTxFKJ+xr/0jxlwklu+NBarbC SuwBButkk9JEAY60Lay/sR6aqO8wOA7NBjFgRXX5A08Bg7VS5cyeQTEVeiy1 aG8cQXlHjuEAxKIPsDxQ2paxchTvZ8OpBSTtKT/MdT0= =y0i/ -----END PGP MESSAGE-----";
var pgpStringExample2 = "-----BEGIN PGP MESSAGE----- Version: OpenPGP.js VERSION Comment: http://openpgpjs.org  wYwDD2MACDvE17QBBAC6YKI1660ENQ6rZ7vGKZcFljqMpR765vv6W5CWux7d k96Fc+EvFBiqvmgvKWCJv1ieSMvTkOp/63RLu22MzDshJkvWoGfTDTxGToRC RPzxBUpAqoMAKR8CC1W9hRJUq0+CWUZK744z4ixhmCnjBeYqEyoXgNawJTUB FLeF91NDCdLC3wHsfSkkUYKKvVCNY52y722vA6nzUyA4ta4YSQ/+Ubo9hNBB d7zmSd1kDfNneJ65zI6xkVG5nOZAh/fWrpYYrU5deRkcM2fJQ8f+DoZgd7xh fPVo1CcVF+/sjMuuc6nJ4ibJUeLOPxQYWiJWROs3GAbdQ4UZgmmwRmL4/q8W aXdEGB1HtkRp8fKdwRysF/qNdx+hjE2lY1n0KS4YyzfRxF4X9ztGUn6CWNtS jud1somSSGXxSlNZ0wNZQ+B71TyvNVlo0hhhQgAtkA7hul5T5aWkTccAGGA0 0hrRw0QkbIPeX7BsxXmszwuR+rIXmJdXw7tHM/CWnOB/fb7+ZghdF/TygZ96 kto0CrvdDMbM+PTL+FFktPp+Js6X8Imk2Femm6vqgYdZitT5zQ/i+RWNn/4M iCXvttk81ssvGUzLj8ULnZ2TqXcjR1u+O2uNeTJFV+ZTPLmKZ4FJj2NJ0c6o DHfdeHRtysOXN0daQXeKp+rc89PbpJbRnCeOGnxLndTEdI9KmLg1NGmQr93j iTohhib6W1p+M7iqDWOXdcOpPD82D7R1O9Oi5L0JUdNe2KFGItjUn3KaEIsF JPzdM07buz8JVEO+6WYHvPZDzM38k0X6GWmeZzbODy7g7jAkPJ2Z8pEfEBdR Xd+bUHUiHOkMA+9hceqEG6I+jRSU+cHPf7uShnzHOiqDCNmuAZPskd4lQi8D QYy9Mz9fBMnUBDM5iqp06HQd7T6/d3NXoyPJN+QpKzKkmxIEkpE08hZJCUnR 0QIrzyON0T1B/4+Zxbh+iFat2AJT9tuX3jAn+lrRNWXKxjnGF0txxedYb/OY 9DdMayWkNi+CyQlwqDZxi/ulnd6pzTQbvuH1HUJ/WVofmvwJYJfM4tU+C4I0 ygZz5UN1E5Gont/RrEjPV32FGXtG9ItXTZUrOzJUiqaJU0OajMZo/etqDzHB PLBHnPElxX8UsD8eWqAWxCz3efqORmK+opvn7ArbDqN5gPcWKDmDY4+nndBi GdGLC/N4zZ0yxL7Og5ibG2Ve14Dn8jUjBEAylkwxPFb6FbNGtUsSU9EoAat0 9HfN3kXnrABd4nHrttQihVq0K7OMucUb8RcdycWoQ/XnybbfaL2I/pgf7EDu V7xibjBm4LZg3zJY+bv/06oGqiLNdlhAGgAFElzd6a692Xg7iFxtKdHKcS+g 38KvO8cpEhO6bcHUJZK5aFYbs+nYB92fB3jjDTA2ag25fPuR6g== =RQbV -----END PGP MESSAGE-----";
var pgpStringExample3 = "-----BEGIN PGP PRIVATE KEY BLOCK----- Version: OpenPGP.js VERSION Comment: http://openpgpjs.org xcFGBFYcKjYBBADstIAzeEauaoHfrXFocivoaXAPTaBzac+ns++0mHcuE3pV eL7goKb4bxDphkntdfUtVqFuOCIdWZFlwnZ7I47pV4LGiYi3ZJxrjvdfwB++ Qpyc/NyFKiPXc7QM5LBXKzNCLGacktYSowz6ypL+Khu2SWL0vyiqQOEPkqBc qH0WxwARAQAB/gkDCO/pgESipUCWYFpUbHcs7tiWEKYVxkx/ZZGwdJp1chlK vUL7XhLzEsaeCbXt15qzQOBiYiC7tDUddXsX/nHqz3kNJ5SV68QN08YFvKSC UwFVA5G1pWmUADah6Z8t4LaVZzVolicONAE5yCBv+96Y6dfmeKvIB4beIq91 SPlC7t6h93vUuxABJb1xWL7xyiId/UlP6smdstY5iIx5VrFwSgpinxjCBaHu zKC6CRHEJwBQDsq3BD2UWHxobEwOXOf3n0LNjf0I3cW7QBtIjr6BH1BW1L0m 2bVWHcNyTBrf6N8Ra6SB4MBoDPEtg2PWBkP0fIJJD6Ya+f5gTl9T0hRJWvh3 Uo7gGJMVZ0s9/a9me2sGTXfL1vNeG3incfqmofYTMkDosYW5rxn5uFFRF0GM +p+cTpELqu2wkE+5gmWc9DX9lT7a426A5W9kpJl4it4m/TN3I2mOEpaMZoMU 4Z+eviKoHxFaTbnvUm0GZQEYPKTI78meRCjNAyA8PsKyBBABCAAmBQJWHCo2 BgsJCAcDAgkQpxqLyQGbXP0EFQgCCgMWAgECGwMCHgEAAGRVA/90ekvPNTsU JRIIPr5IOe3qioNwhXe3/D/hn8Lfgm8JrKTPQ99mPEPITYbbPfgWF+7WkdHx ccwiAHksCbfrWVuQ8GDTTmFKOlF6ySzMJlD74dJFpI2B/Us70W1nUFgBLkFj 844zWZUA50OZaf9O4zrUVsVMG/KdPyyO8PsuNSccZcfBRgRWHCo2AQQA5Nly xvkUHuFyT1+juVsTS4bJo7wzFoUht4nLIy+kAucLu8XA87jpPFZvuj5mQpxH MGr/1PVS2Ju2HjP/sf/IJ6kCOgoTattUfEh7jEGG0AAGQETRBcI5r7XTZQkI rIzuNB05PyqSs0ldVxLp+bCk277a/QwIMCySmcZoKo7VbUcAEQEAAf4JAwhk otvG13gYvGDIA5SUWwIRYswbGt6eZfhOsjAmLqzVmN+8kvUxa/3tKTFv1c0o iFGxXBdXxHiPiH96PSZEt0qcc5/F/WjzLuCuCHJw/y/DphkL28Oj5yypPX7P Go9WpkysXroG2bOpT6J8k2j76IXMpWx3wYcDwHyC6tj0mBE2g4lv/2FC7Rbq ulzphFgM2mIEtmXopYSHaK6tlYcb7icyKRE3fnrcSCHDVmVPnnkjkvTJuHjt SDODMN9HhNFzHU+xb7ddUkkSo1AZOBn4UJokJziPUDg85K5sZGYBXopBAVum jOvceRKxB4itDCKjurmBCeTQ4XoLZiFOnoP/PBnVOCfgvHSxu9k4FyEyFCz6 vYk4kX5BeXFSegvRcnV2ZHTgfERpFEPSS2To2XO+MHoDbVeRGvPcO5pVSqJa xdq7sTayNqe8cYYU0s0gWBg2W904k5gk5ufZ6YR/+REUY92pCJPSt9TFWj/s HEtRU+xoxu+mIHizwp8EGAEIABMFAlYcKjYJEKcai8kBm1z9AhsMAADMNgP+ OQXRf6deVxceYbAoakZrnvm5PPV50QS4TsbdqGUJ38qEPtS4LOInzXPXWnx/ ljAiT5Wn4506q8Dj6SZvLl0CAH2ElgS8s+TU4R6lG/E8WxISjoAYchYlOwtL Ytbk4xTkXqfzytO+j2UadUvOhWirEp8C4JDiAewhPiteKfnuyco= =5Yy5 -----END PGP PRIVATE KEY BLOCK-----";
var pgpStringExample4 = "-----BEGIN PGP PUBLIC KEY BLOCK----- Version: OpenPGP.js VERSION Comment: http://openpgpjs.org  xo0EVhwqNgEEAOy0gDN4Rq5qgd+tcWhyK+hpcA9NoHNpz6ez77SYdy4TelV4 vuCgpvhvEOmGSe119S1WoW44Ih1ZkWXCdnsjjulXgsaJiLdknGuO91/AH75C nJz83IUqI9dztAzksFcrM0IsZpyS1hKjDPrKkv4qG7ZJYvS/KKpA4Q+SoFyo fRbHABEBAAHNAyA8PsKyBBABCAAmBQJWHCo2BgsJCAcDAgkQpxqLyQGbXP0E FQgCCgMWAgECGwMCHgEAAGRVA/90ekvPNTsUJRIIPr5IOe3qioNwhXe3/D/h n8Lfgm8JrKTPQ99mPEPITYbbPfgWF+7WkdHxccwiAHksCbfrWVuQ8GDTTmFK OlF6ySzMJlD74dJFpI2B/Us70W1nUFgBLkFj844zWZUA50OZaf9O4zrUVsVM G/KdPyyO8PsuNSccZc6NBFYcKjYBBADk2XLG+RQe4XJPX6O5WxNLhsmjvDMW hSG3icsjL6QC5wu7xcDzuOk8Vm+6PmZCnEcwav/U9VLYm7YeM/+x/8gnqQI6 ChNq21R8SHuMQYbQAAZARNEFwjmvtdNlCQisjO40HTk/KpKzSV1XEun5sKTb vtr9DAgwLJKZxmgqjtVtRwARAQABwp8EGAEIABMFAlYcKjYJEKcai8kBm1z9 AhsMAADMNgP+OQXRf6deVxceYbAoakZrnvm5PPV50QS4TsbdqGUJ38qEPtS4 LOInzXPXWnx/ljAiT5Wn4506q8Dj6SZvLl0CAH2ElgS8s+TU4R6lG/E8WxIS joAYchYlOwtLYtbk4xTkXqfzytO+j2UadUvOhWirEp8C4JDiAewhPiteKfnu yco= =SwbH -----END PGP PUBLIC KEY BLOCK-----";





window.onload = function() {
    var textFile = null,
    makeTextFile = function (text) {
        var data = new Blob([text], {type: 'text/plain'});

        // If we are replacing a previously generated file we need to
        // manually revoke the object URL to avoid memory leaks.
        if (textFile !== null) {
          window.URL.revokeObjectURL(textFile);
        }

        textFile = window.URL.createObjectURL(data);

        // returns a URL you can use as a href
        return textFile;
    };

    var toFile = pgpStringFormat(pgpStringExample1) + "\r\n\r\n\r\n";
    toFile += pgpStringFormat(pgpStringExample2) + "\r\n\r\n\r\n";
    toFile += pgpStringFormat(pgpStringExample3) + "\r\n\r\n\r\n";
    toFile += pgpStringFormat(pgpStringExample4) + "\r\n\r\n\r\n";

    $("#downloadPGP").attr("href",makeTextFile(toFile));
};