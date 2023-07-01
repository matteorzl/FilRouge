<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
       
    </head>
    <body>
        <div class="header">
            <a href="index.php" class="logo">Airneis</a>
            <div class="header-right">
                <input type="text" placeholder="Rechercher..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
                <?php if(isset($_SESSION['username'])): ?>
                    <svg class="compte" viewBox="-4.56 -4.56 33.12 33.12" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" transform="matrix(1, 0, 0, 1, 20, 0)" stroke="#ffffff">
                        <a href ="compte.php">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                                <rect x="-4.56" y="-4.56" width="33.12" height="33.12" rx="16.56" fill="#ffffff" strokewidth="0"></rect>
                            </g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.7280000000000002"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#000000;stroke-miterlimit:10;stroke-width:1.91px;}</style>
                                </defs>
                                <circle class="cls-1" cx="12" cy="7.25" r="5.73"></circle>
                                <path class="cls-1" d="M1.5,23.48l.37-2.05A10.3,10.3,0,0,1,12,13h0a10.3,10.3,0,0,1,10.13,8.45l.37,2.05"></path>
                            </g>
                        </a>
                    </svg>
                    
                <?php else: ?>
                    <svg class="compte" viewBox="-4.56 -4.56 33.12 33.12" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" transform="matrix(1, 0, 0, 1, 20, 0)" stroke="#ffffff">
                        <a href ="login.php">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                                <rect x="-4.56" y="-4.56" width="33.12" height="33.12" rx="16.56" fill="#ffffff" strokewidth="0"></rect>
                            </g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.7280000000000002"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#000000;stroke-miterlimit:10;stroke-width:1.91px;}</style>
                                </defs>
                                <circle class="cls-1" cx="12" cy="7.25" r="5.73"></circle>
                                <path class="cls-1" d="M1.5,23.48l.37-2.05A10.3,10.3,0,0,1,12,13h0a10.3,10.3,0,0,1,10.13,8.45l.37,2.05"></path>
                            </g>
                        </a>
                    </svg>
                <?php endif ?>
                <svg class="panier" viewBox="-6.08 -6.08 44.16 44.16" id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#ffff" transform="matrix(1, 0, 0, 1, 81, -29)" stroke="#ffff" stroke-width="0.00032"><a href ="panier.php"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-6.08" y="-6.08" width="44.16" height="44.16" rx="22.08" fill="#ffff" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ffff" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"> <defs id="defs2"></defs> <g id="layer1" transform="translate(-12,-292)"> <path d="m 21,316.00586 c -1.645008,0 -3,1.35499 -3,3 0,1.64501 1.354992,3 3,3 1.645008,0 3,-1.35499 3,-3 0,-1.64501 -1.354992,-3 -3,-3 z m 0,2 c 0.564129,0 1,0.43587 1,1 0,0.56413 -0.435871,1 -1,1 -0.564129,0 -1,-0.43587 -1,-1 0,-0.56413 0.435871,-1 1,-1 z" id="circle5400" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1"></path> <path d="m 35.999999,316.00586 c -1.645008,0 -3,1.35499 -3,3 0,1.64501 1.354992,3 3,3 1.645008,0 3,-1.35499 3,-3 0,-1.64501 -1.354992,-3 -3,-3 z m 0,2 c 0.564129,0 1,0.43587 1,1 0,0.56413 -0.435871,1 -1,1 -0.564129,0 -1,-0.43587 -1,-1 0,-0.56413 0.435871,-1 1,-1 z" id="circle5402" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1;"></path> <path d="m 15,294.00586 c -0.552285,0 -1,0.44772 -1,1 0,0.55228 0.447715,1 1,1 h 1.179688 l 2.65039,13.24219 C 17.759297,309.70823 17,310.77542 17,312.00586 c 0,1.6447 1.355301,3 3,3 h 18.011718 c 0.552285,0 1,-0.44772 1,-1 0,-0.55228 -0.447715,-1 -1,-1 H 20 c -0.571296,0 -1,-0.4287 -1,-1 0,-0.5713 0.428704,-1 1,-1 h 16.011718 3 c 0.492161,2.4e-4 0.911339,-0.35764 0.988281,-0.84375 l 1.730469,-11 c 0.09599,-0.60725 -0.373487,-1.15652 -0.988281,-1.15625 H 18.619141 l -0.638672,-3.19531 C 17.887292,294.34287 17.476874,294.00603 17,294.00586 Z m 4.019531,6 h 20.552734 l -1.416016,9 L 20.820312,309 Z m 3.980469,2 c -0.552285,0 -1,0.44772 -1,1 0,0.55228 0.447715,1 1,1 h 13.011718 c 0.552285,0 1,-0.44772 1,-1 0,-0.55228 -0.447715,-1 -1,-1 z m 2,3 c -0.552285,0 -1,0.44772 -1,1 0,0.55228 0.447715,1 1,1 h 9.011718 c 0.552285,0 1,-0.44772 1,-1 0,-0.55228 -0.447715,-1 -1,-1 z" id="path5404" style="color:#000000;fill:#000000;fill-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4.1"> </path></g></g></a></svg>
                <svg class="contact" width="35px" height="35px" fill="#000000" viewBox=" -30 -10 120 80" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" transform="matrix(1, 0, 0, 1, 336, -29)" stroke="#000000" stroke-width="1.5"><a href ="contact.php"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-30" y="-30" width="200" height="119.04" rx="59.52" fill="#ffffff" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="_x32_5_attachment"></g> <g id="_x32_4_office"></g> <g id="_x32_3_pin"></g> <g id="_x32_2_business_card"></g> <g id="_x32_1_form"></g> <g id="_x32_0_headset"></g> <g id="_x31_9_video_call"></g> <g id="_x31_8_letter_box"></g> <g id="_x31_7_papperplane"></g> <g id="_x31_6_laptop"></g> <g id="_x31_5_connection"></g> <g id="_x31_4_phonebook"></g> <g id="_x31_3_classic_telephone"></g> <g id="_x31_2_sending_mail"></g> <g id="_x31_1_man_talking"></g> <g id="_x31_0_date"></g> <g id="_x30_9_review"></g> <g id="_x30_8_email"> <g> <g> <path d="M35.0137,31.8325c0.5488-0.0596,0.9453-0.5532,0.8857-1.1021c-0.0596-0.5493-0.5518-0.9434-1.1025-0.8862 c-6.4932,0.7036-9.5806-1.688-11.0259-3.8203c-2.0195-2.98-2.0645-7.2817-0.1143-10.959 c1.9429-3.6626,5.356-5.7627,9.3657-5.7627c0.001,0,0.002,0,0.0029,0c3.0547,0,5.7949,1.2461,7.3301,3.3325 c1.6016,2.1763,1.8633,5.2012,0.7578,8.7485c-0.4336,1.3921-1.8486,3.2183-3.0938,3.5781 c-0.5078,0.1484-0.9092,0.0938-1.2236-0.1665c-0.3623-0.3013-0.4922-0.769-0.4814-0.9541 c0.002-0.0117,0.0029-0.0225,0.0039-0.0342l1.0957-10.9561c0.0586-0.5493-0.3389-1.042-0.8877-1.1001 c-0.5586-0.061-1.042,0.3389-1.1006,0.8882l-0.0969,0.9086c-0.0175-0.013-0.0319-0.0287-0.0496-0.0414 c-1.2813-0.9214-3.0767-1.0112-4.8047-0.2397c-2.9424,1.3115-5.0669,5.48-4.5469,8.9199c0.3901,2.5801,2.209,4.251,4.9917,4.5845 c1.2773,0.1519,2.8452-0.2251,4.0083-1.085c0.1689,0.2427,0.3682,0.4634,0.5908,0.6484 c0.8242,0.6836,1.9092,0.8794,3.0566,0.5488c2.0088-0.5811,3.8389-2.9502,4.4482-4.9048 c1.6445-5.2793,0.333-8.6396-1.0566-10.5283c-1.9111-2.5972-5.2539-4.1475-8.9414-4.1475c-0.001,0-0.002,0-0.0029,0 c-4.7739,0-8.8315,2.4878-11.1323,6.8252c-2.293,4.3232-2.2046,9.4331,0.2256,13.0186 c2.1333,3.1475,5.8232,4.8188,10.5332,4.8188C33.4111,31.9648,34.2002,31.9209,35.0137,31.8325z M34.9131,17.4961l-0.5693,5.9414 c-0.5811,0.9546-2.1055,1.4746-3.1875,1.3472c-1.9009-0.228-2.9946-1.2026-3.251-2.8975 c-0.3848-2.5454,1.2593-5.8477,3.3838-6.7949c0.5137-0.229,1.0332-0.3433,1.5107-0.3433c0.5029,0,0.96,0.1274,1.3115,0.3804 C34.7412,15.582,35.0176,16.4004,34.9131,17.4961z"></path> <path d="M59.3057,21.6533l-7.2637-4.4982V2c0-0.5522-0.4473-1-1-1H12.4771c-0.5522,0-1,0.4478-1,1v15.0159 c-3.4714,2.1884-5.806,3.7847-6.9165,4.7346c-1.5254,1.3042-2.3652,3.1631-2.3652,5.2334v29.0249 C2.1953,59.8638,5.3315,63,9.186,63h45.6284c1.8837,0,3.5925-0.7524,4.8508-1.9683c0.0023-0.0023,0.0054-0.003,0.0076-0.0053 c0.0011-0.0012,0.0013-0.0027,0.0024-0.0039c1.3107-1.2715,2.1294-3.0475,2.1294-5.0137V26.9839 C61.8047,25.2393,61.1504,22.7964,59.3057,21.6533z M52.042,19.5073l5.0593,3.1331l-5.0593,4.4129V19.5073z M58.784,23.826 c0.6964,0.7996,1.0207,2.077,1.0207,3.1579v29.0249c0,1.0747-0.3491,2.0649-0.9291,2.8804L39.5911,40.5665L58.784,23.826z M13.4771,3H50.042v25.7969L31.998,44.5361l-18.521-16.1475V3z M11.4771,19.3841v7.2624L6.7792,22.551 C7.835,21.7673,9.4214,20.6976,11.4771,19.3841z M4.1953,56.0088V26.9839c0-1.1927,0.3796-2.2405,1.0782-3.0918l19.8513,17.3058 L5.7814,59.6376C4.8109,58.7264,4.1953,57.4419,4.1953,56.0088z M9.186,61c-0.5724,0-1.1138-0.1168-1.6263-0.295l19.0789-18.1874 l4.7021,4.0992c0.1885,0.1641,0.4229,0.2461,0.6572,0.2461s0.4692-0.082,0.6572-0.2466l5.4222-4.7294l19.3299,18.3657 C56.6494,60.7177,55.7672,61,54.8145,61H9.186z"></path> </g> </g> </g> <g id="_x30_7_information"></g> <g id="_x30_6_phone_talking"></g> <g id="_x30_5_women_talking"></g> <g id="_x30_4_calling"></g> <g id="_x30_3_women"></g> <g id="_x30_2_writing"></g> <g id="_x30_1_chatting"></g> </g></a></svg>
            <!--<a class="active" href="#home">Home</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>-->
            </div>
        </div>
    </body>
</html>