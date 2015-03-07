<ul class="pagination ">
    <?php  for($i=1;$i<($number_of_pages+1);$i++){  ?>
            <li <?php  if($i== $current_page){echo   'class="active"';} ?>>
                <a href="<?php  echo ($i!= $current_page)? base_url($action_url."?page=".$i) : '#'; ?>">
                    <?php echo $i?>
                </a>
            </li>
    <?php  }//for   ?>   
 </ul>