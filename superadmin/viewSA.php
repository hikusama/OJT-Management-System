<?php




function getCont()
{
    if (isset($_GET['a'])) {
        echo '<div id="ovv" ">
            <div class="cards">
                <li>
                    <i class="fas fa-user-graduate"></i>
                    <div class="mgs">
                        <h4 id="studnum">521</h4>
                        <p>students</p>
                    </div>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <div class="mgs">
                        <h4 id="coor">320</h4>
                        <p>coordinator</p>
                    </div>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <div class="mgs">
                        <h4 id="trainees">53</h4>
                        <p>trainees</p>
                    </div>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <div class="mgs">
                        <h4 id="ad">230</h4>
                        <p>admins</p>
                    </div>
                </li>
            </div>

            <div class="middleC">
                <canvas id="myChart" style="display: block; width: 100%; max-width: 600px;"></canvas>



                <div class="status">
                    <h3>Status</h3>
                    <div class="headStatus">
                        <label for="#">Students</label>
                        <label for="#">Trainees</label>
                        <label for="#">Coordinators</label>
                        <label for="#">Admins</label>
                    </div>
                </div>
                <div class="calendar">
                    <div id="month" class="date"></div>
                    <div id="day" class="date"></div>
                    <div id="weekday" class="date"></div>
                    <div class="mNy">
                        <div id="year" class="date"></div>
                    </div>
                </div>
            </div>
        </div>';
    }else{
        echo '<h1 id="ad"> Hello </h1>';
    }
}
