<!-- Modal for viewing pending participants and volunteers -->
<div class="modal fade" id="participantsModal-<?php echo $row2['event_id']; ?>" tabindex="-1" aria-labelledby="participantsModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="participantsModalLabel">Pending Participants and Volunteers</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <!-- Fetch the pending participants and volunteers from the database -->
            <?php
               $event_id = $row2['event_id'];
               $participants_sql = "SELECT * FROM participants WHERE event_id = $event_id AND status = 'pending'";
               $volunteers_sql = "SELECT * FROM volunteers WHERE event_id = $event_id AND status = 'pending'";
               $participants_result = $conn->query($participants_sql);
               $volunteers_result = $conn->query($volunteers_sql);
            ?>
            
            <!-- Display Participants Table -->
            <h6>Pending Participants:</h6>
            <?php if ($participants_result->num_rows > 0): ?>
            <table class="table">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php while ($participant = $participants_result->fetch_assoc()): ?>
                  <tr>
                     <td><?php echo $participant['name']; ?></td>
                     <td><?php echo $participant['email']; ?></td>
                     <td>
                        <form method="POST" action="approve_participant.php">
                           <input type="hidden" name="participant_id" value="<?php echo $participant['id']; ?>">
                           <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                           <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                     </td>
                  </tr>
                  <?php endwhile; ?>
               </tbody>
            </table>
            <?php else: ?>
            <p>No pending participants.</p>
            <?php endif; ?>
            
            <!-- Display Volunteers Table -->
            <h6>Pending Volunteers:</h6>
            <?php if ($volunteers_result->num_rows > 0): ?>
            <table class="table">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php while ($volunteer = $volunteers_result->fetch_assoc()): ?>
                  <tr>
                     <td><?php echo $volunteer['name']; ?></td>
                     <td><?php echo $volunteer['email']; ?></td>
                     <td>
                        <form method="POST" action="approve_volunteer.php">
                           <input type="hidden" name="volunteer_id" value="<?php echo $volunteer['id']; ?>">
                           <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                           <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                     </td>
                  </tr>
                  <?php endwhile; ?>
               </tbody>
            </table>
            <?php else: ?>
            <p>No pending volunteers.</p>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>