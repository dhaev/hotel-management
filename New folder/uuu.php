<!--select  >
               <?/*php
               $sql="SELECT rtype FROM room_type   ";
               $result=mysqli_query($conn,$sql);

               while($row=mysqli_fetch_assoc($result)){
               echo '<option>'.$row['rtype'].'</option>';

               }
               ?>
           
         </select>



            <select  >
               <?php
               $sql="SELECT rnum FROM add_room WHERE NOT EXISTS (SELECT rnum FROM book)";
               $result=mysqli_query($conn,$sql);

               while($row=mysqli_fetch_assoc($result)){
               echo '<option>'.$row['rnum'].'</option>';

               }
              ?>
           
         </select-->

          
 