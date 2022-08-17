<?php
    while ($users = $usersQuery->fetchAll(PDO::FETCH_ASSOC)) {

        // pour chaque utilisateurs
        foreach ($users as $userKey => $user) {
                
            // si status = connecter on ajoute la classe connecte a notre icon status
            ($user['status'] === 'connecter') ? $status = 'connecter' : $status = '' ;

                $renderedUser .=  '<a href="chat.php?id='. $user['id'] .'">
                    <div class="user">
                        <div class="leftUser">
                            <img class="imageProfil" src="assets/images/' . $user['image'] . '" alt="">
                            <div class="name">
                                <h3>' . $user['firstName'] . ' ' . $user['lastName'] . '</h3>
                                <p class="message"></p>
                            </div>
                        </div>
                        <div class="status ' . $status . 
                        '">
                            <i class="fas fa-circle"></i>
                        </div>          
                    </div>
                </a>';
            
        };
    };
?>