<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}
?>

<html>

<head>
    <title>Menu Student</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/admin_student.css">
    <script src="../JS/admin_dashboard.js"></script>
</head>

<body>
    <nav>
        <?php
        $user_id = strval($_SESSION["user_id"]);
        $query = "SELECT name FROM admin WHERE uaid = $1";
        $result = pg_query_params($db, $query, [$user_id]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            if ($row) {
                echo "<h1 id='nav_user_name'>" . strtoupper($row["name"]) . "</h1>";
            } else {
                //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
                header("Location: ../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error hi: " . pg_last_error($db);
        }
        pg_close($db);
        ?>
        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../admin_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_student"><a href="./student.php">Student</a></li>
            <li class="nav_menu_options" id="menu_teacher"><a href="./teacher.php">Teacher</a></li>
            <li class="nav_menu_options" id="menu_admin"><a href="./admin.php">Admin</a></li>
            <li class="nav_menu_options" id="menu_course"><a href="./course.php">Course</a></li>
            <li class="nav_menu_options" id="menu_notices"><a href="./notices.php">Notices</a></li>
            <li class="nav_menu_options" id="menu_feedback"><a href="./feedback.php">Feedback</a></li>
            <li id="update_info" class="nav_menu_options"><a href="./update_info.php">Update Info</a></li>
            <li id="logout" class="nav_menu_options"><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
    <div id="content">
        <center>
            <p id="clg_title">K K Wagh Arts, Commerce, Science and Computer Science College
                <?php echo "(" . $_SESSION['user_type'] . " account)"; ?>
            </p>
        </center>
        <p>Content Area<br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime praesentium recusandae laudantium autem odio debitis magni, libero mollitia aperiam explicabo sapiente qui sequi distinctio necessitatibus harum sed repudiandae, eligendi voluptate et illum ex! Dolores quas facere illum possimus soluta? Eligendi reprehenderit illo libero cum officia deleniti doloremque excepturi? Ipsa odit aut quam sapiente reprehenderit itaque repudiandae, fuga velit, quisquam dolorum assumenda rerum cupiditate nam et necessitatibus. Magni dignissimos quidem, omnis commodi a laborum temporibus vitae cupiditate cum esse, perspiciatis distinctio explicabo. Magni voluptates odio debitis voluptatum optio alias fuga, sit molestias, placeat, consequatur sequi delectus? Aliquid necessitatibus tempore fuga cum, incidunt molestias ad ullam doloribus quisquam saepe voluptatem magni quia provident nostrum modi amet similique quas natus laudantium, delectus suscipit accusamus possimus. Nulla qui, saepe neque, animi architecto aliquid quas consequuntur quibusdam vitae quaerat sint ullam velit dicta accusamus blanditiis sequi temporibus in nobis ipsam alias culpa non incidunt. Pariatur hic maiores nisi molestias corrupti voluptates culpa, nam dolor commodi quis accusantium deleniti sed fugit sapiente, impedit natus aperiam praesentium nemo quod rem corporis quidem repellat, illo ipsam. Eos, itaque? Qui quod tenetur quia voluptas omnis? Nobis, iure modi! Facilis deserunt eveniet quo soluta quod quas ratione possimus explicabo saepe tempore? Quia quis hic enim architecto autem laudantium consequuntur magni obcaecati repellat amet sequi fugiat, provident doloremque dolore qui beatae, molestiae dolorum ipsa rem cum, expedita quidem? Veritatis non explicabo saepe illum commodi unde assumenda iure dolor eum maxime reiciendis aperiam harum nihil quam amet sequi nesciunt neque, odit porro ex laborum quis perferendis suscipit debitis? Quaerat, maxime placeat. Expedita tempore eligendi voluptatem placeat quasi veritatis ea repellat quia, nisi quibusdam et provident, officia dolorum, at ducimus facere debitis ullam voluptas dolorem facilis? Eligendi labore sed incidunt unde dicta voluptates deleniti neque, itaque iusto laudantium debitis autem suscipit corporis, minus vero, accusamus cupiditate? Molestiae corrupti iusto, obcaecati magnam possimus repellat. Corporis fugiat aut ullam, odio consequatur autem nobis voluptatem nam incidunt. Qui expedita magni sit vero quod laudantium recusandae molestias, iure temporibus ipsum sed quibusdam sapiente ullam vel possimus corporis fugiat? Harum perferendis laudantium earum obcaecati culpa ipsam ea itaque magni, repellendus commodi sed, sapiente similique cumque eaque, quos nam quam? Veritatis voluptatibus minima labore officia, enim, porro maxime quod nostrum voluptas aliquam, laboriosam ipsum architecto itaque. Tempora nihil labore corporis perferendis quos voluptate ab aperiam amet odit! Ipsa error nam sunt deserunt ut necessitatibus debitis id fuga, fugiat quidem et nemo eum tempore. Doloribus suscipit provident nisi dolorum rerum officia nam voluptatibus, voluptate optio neque iste obcaecati rem ab vel et, officiis laboriosam modi quidem, nobis voluptates aperiam placeat? Velit, fugiat. Ipsa suscipit laborum quo? Quod, illum corrupti. Harum nihil molestiae reiciendis labore itaque dolores libero voluptatem earum. Eius nulla tenetur eveniet aliquam rerum voluptas provident aperiam. Amet debitis id libero cum asperiores saepe modi vitae ut expedita optio, alias animi. Pariatur quia obcaecati iste odio commodi ratione corrupti at nam accusamus sed? Repellat voluptatum perspiciatis iste earum maxime magnam ipsum, excepturi reprehenderit vitae ipsa eos reiciendis laborum unde praesentium, aut nulla! Qui nesciunt quibusdam laboriosam ex cum, repudiandae incidunt exercitationem provident unde odit cupiditate, dolor eum sunt repellendus voluptatem non veritatis dolorem asperiores vel? Molestiae doloribus magnam corrupti, officia, expedita debitis consequatur itaque animi repellendus, autem unde similique magni veniam alias ducimus aliquam minima hic temporibus. Facere natus earum, animi est corrupti maiores vel laudantium doloremque eligendi, voluptatibus consectetur iusto quaerat enim tempora voluptate accusamus temporibus harum voluptatem nobis ut sequi aliquam, esse error. Nisi adipisci nulla, quasi labore vero ab nihil eos quae, ducimus optio laborum tenetur natus fugiat. Atque modi nemo facilis, fugiat, explicabo est distinctio voluptatem sit sint similique ratione? Similique, cupiditate eaque. Ducimus aliquam incidunt cum. Explicabo ipsum cum ea culpa harum, labore voluptatum, repellendus porro iure eaque sunt laborum aperiam doloremque! Harum nam, consectetur temporibus delectus adipisci incidunt iste minus saepe sint fugit quaerat reprehenderit quia aut officia suscipit laborum, doloremque deserunt aliquam repellat corporis. Deleniti facere nemo eligendi sit. Eos magnam nisi debitis neque repellendus ex molestiae, eum soluta sapiente fugiat, tempore dolore minus a enim cupiditate assumenda, excepturi quas alias. Beatae voluptatum possimus maiores rem quam dignissimos obcaecati? Delectus, nam adipisci? Repellendus rerum magnam architecto laborum distinctio necessitatibus? Adipisci atque eveniet nostrum consequatur, laudantium quia, sint dolorum exercitationem quis at possimus voluptas. Mollitia autem corporis ipsa voluptates modi sapiente perspiciatis provident ullam minima rerum, obcaecati, ab voluptatem enim alias doloribus magni aliquid quae voluptatibus laudantium iste ut! Omnis quo dolore libero sed velit voluptatum reprehenderit magni quibusdam illo minus. Accusantium alias exercitationem earum repudiandae qui ipsam enim amet sunt aliquid, facere doloremque impedit dignissimos velit. Delectus nihil fuga voluptatem non omnis dolorum dolore accusamus temporibus saepe, eum voluptate in? Exercitationem cum cupiditate nisi labore velit eius accusamus ea nulla magnam dolor iure nostrum porro nemo quo veritatis unde numquam nihil fuga tempora voluptate, nam delectus ipsam ratione. Nostrum voluptatibus enim, sit voluptatem odit debitis obcaecati earum totam quos quod dignissimos porro soluta, quibusdam nisi natus dolores est doloribus officia assumenda sint? Illum impedit fuga nostrum ipsa molestias voluptates tempore labore commodi incidunt, cupiditate sequi nulla, esse reprehenderit quos dolores architecto veniam, accusantium voluptatum error. Itaque dignissimos beatae sunt perspiciatis totam! Repellat nihil aliquid neque ipsum repudiandae exercitationem praesentium voluptas soluta sapiente, molestias cum laborum nobis tempore obcaecati quaerat modi dolor numquam suscipit ullam, qui unde inventore est. Ex saepe voluptas nobis nihil harum repudiandae dignissimos fugit libero sit. Expedita consectetur quas ex? Reprehenderit labore voluptas magni? Ullam voluptate perspiciatis eius facere at velit natus, reprehenderit earum accusamus exercitationem, labore odit! Quidem atque ipsa totam ipsam doloribus quis nisi sapiente incidunt sit corrupti voluptatum veniam, corporis cum, magnam esse, dignissimos asperiores perferendis maiores dicta odit ab dolorem! Quam eum necessitatibus magni quod quas vel? Sapiente soluta qui esse veritatis odio. Debitis temporibus vero suscipit, doloremque unde ad laudantium. Asperiores dolore repellendus at dicta quo aut tempore! Quibusdam error fuga eaque consequuntur impedit doloribus nam tempore velit facilis ea minus fugit adipisci eos eum veniam soluta in natus, ipsa voluptatem. Quisquam maxime, ex nam ipsa natus cumque necessitatibus fugit reprehenderit vel quibusdam! Mollitia tenetur aperiam rerum iure dolore doloremque nihil, in autem a eos natus quia eum dolores non optio fuga quidem quae maiores, libero excepturi similique? Veritatis, repellat debitis. Ut doloremque autem voluptas optio dicta odit aspernatur excepturi, facilis possimus. Quia, quis expedita ducimus incidunt cum quidem est sequi iste perferendis rem. Laboriosam alias tempora tempore ab iusto explicabo obcaecati consequuntur repudiandae doloremque voluptatibus, incidunt soluta ex! Tempora voluptatibus molestias praesentium deleniti qui tenetur at facilis ratione provident hic impedit quam suscipit laudantium, ipsam similique vel veniam expedita minus laboriosam enim. Aperiam, inventore ullam? Perferendis, ut voluptate alias ipsum odio dolores similique, sint obcaecati animi nesciunt inventore minus! Labore voluptates commodi vero impedit ducimus aliquid odio ullam veniam suscipit cum itaque quia velit unde, vel, reiciendis in quis consequatur asperiores maxime perferendis possimus. Repellat quasi recusandae inventore alias vero! A reiciendis veniam obcaecati alias nesciunt distinctio reprehenderit adipisci quaerat culpa molestiae esse in atque necessitatibus rerum cupiditate doloremque, magni quia minima eius id optio! Quod obcaecati fugit, mollitia, eaque sequi et earum incidunt facilis enim neque quae facere. Cumque, facilis totam. Nihil asperiores saepe, quo labore incidunt dolorem pariatur sapiente facere, assumenda unde eos soluta voluptatem quod sit, placeat consectetur neque provident repellat perspiciatis voluptas harum sint eius excepturi! Veniam beatae cumque in facilis praesentium modi exercitationem, voluptate fugit delectus repellat, sed officia nesciunt eligendi? Incidunt delectus deleniti blanditiis dolore. Sit maiores nisi inventore asperiores accusamus sint placeat non in? Facere numquam recusandae ullam aspernatur a quidem, inventore quas aliquam odio minus totam rerum natus quaerat consectetur, molestiae perspiciatis quibusdam possimus iusto. Aliquam consequatur voluptates debitis excepturi architecto, autem perferendis reiciendis doloremque at est veritatis quos commodi cum. Necessitatibus praesentium quis facere. Saepe aspernatur distinctio obcaecati, voluptas id mollitia. Totam, nisi animi rem illo nobis quia, doloribus doloremque dolorum dignissimos sapiente vel laudantium accusamus nam quibusdam quaerat in ratione dicta. Molestias incidunt facilis deserunt autem dignissimos modi commodi nisi ad libero ducimus fugit, sint nihil aut quam, vel at? Est consequatur cumque inventore sit explicabo laborum reprehenderit, alias dolores aut possimus! Eaque error, doloribus, aliquam totam provident cupiditate in sed ullam aut asperiores distinctio fugit? Quasi, numquam ratione. Tempore reiciendis nemo dicta dolorum modi? Commodi nam eveniet asperiores voluptate repellendus nobis perspiciatis totam nostrum laboriosam aliquam ea, itaque, nesciunt cumque ab temporibus debitis magnam! Ipsum incidunt praesentium eius veritatis quia labore numquam vitae quas, quibusdam velit optio sequi pariatur expedita sint voluptatum quod aspernatur. Culpa quis delectus dolore recusandae aliquid ullam sed temporibus, nobis id similique neque error harum voluptas rerum iste laboriosam architecto, exercitationem quasi consequuntur eos facere officia! Eum iure autem laudantium numquam sint reiciendis quo ducimus corporis voluptatibus inventore eius dolore adipisci, laboriosam, ut ad deleniti ab quae modi veniam dolorum debitis atque. Culpa quo dolor voluptas obcaecati vel assumenda voluptatum laborum hic architecto, quasi possimus omnis laudantium incidunt neque dicta sapiente iure recusandae reiciendis cumque saepe exercitationem voluptatem illum pariatur repellendus! Unde doloremque cumque dicta exercitationem sunt. Dolor sed, suscipit minima incidunt quidem ducimus dignissimos quisquam, voluptates aperiam quia nihil labore accusantium consequatur aut quos aspernatur quam ipsum hic quae culpa? Accusantium tempore quis doloremque, illo praesentium quas eaque quod quisquam. Quibusdam eaque odio sed repellendus voluptates omnis vero molestiae quis consectetur? Blanditiis ducimus magnam nihil tenetur reprehenderit repellendus quasi! Quisquam deserunt odit nobis aliquid similique blanditiis ex consequatur tempore laudantium in, aperiam nihil quae rerum veniam mollitia ratione. Cupiditate, at beatae odit ut a deserunt voluptate iste facilis rerum quaerat quae quod non nulla tempore similique provident tenetur! Reprehenderit ipsum ducimus sapiente necessitatibus, molestias adipisci officiis id dolorum, maiores illum aliquid sunt! Tenetur blanditiis totam minima at esse dolore vel adipisci modi nam, veritatis nisi, ipsam ratione qui porro! Aliquam, velit nobis nostrum perspiciatis voluptates possimus cum atque ad omnis ab aliquid adipisci. Saepe corporis quas magni voluptate qui. Temporibus rem neque asperiores cumque culpa nemo adipisci soluta. Voluptatum quis suscipit explicabo facilis atque, est fuga vel, enim quia aliquam pariatur quisquam? Enim ad similique rerum consequuntur possimus molestiae laboriosam quas quae quia aspernatur natus dolor recusandae asperiores iusto in, architecto quidem iure pariatur magnam, blanditiis, sunt odit. Architecto necessitatibus hic, ducimus cumque non expedita accusamus officia, delectus quae sunt ut dolorem minus doloribus, magnam in explicabo at voluptate! Consectetur, a aut delectus officia unde sed molestiae debitis rerum, quis doloribus, consequuntur dignissimos dolorem? Tenetur laboriosam natus quaerat est iusto ipsum enim beatae alias commodi ab neque odio incidunt nemo repudiandae ducimus at atque, esse cumque perferendis! Voluptates libero dicta rerum accusamus numquam. Laborum, facere possimus suscipit neque dolore, blanditiis doloremque nobis odio sint accusamus aliquam eum eos cupiditate, nisi esse enim voluptatum optio! Eius soluta veniam omnis sit, voluptatibus deserunt nam officia culpa repellendus molestiae quisquam, amet sint reprehenderit consectetur explicabo velit cumque quam aliquam minima inventore voluptatum magnam quidem obcaecati? Quos non numquam nostrum omnis id saepe nulla labore suscipit dolores quis quae enim ut maxime perferendis aliquid laudantium repellendus, harum iusto minima ipsa minus veritatis. Blanditiis suscipit omnis autem saepe perspiciatis corporis illo soluta? Dignissimos unde, ipsam eum iste possimus omnis laboriosam aspernatur provident at blanditiis repudiandae officiis reiciendis cupiditate impedit quasi quod quisquam eius. Nisi pariatur, eveniet deleniti aliquid rem ullam labore eum mollitia laudantium optio totam dolore eos illum? Itaque dolorum quod amet nostrum totam voluptates maxime omnis, reprehenderit dolore repellat cum incidunt dignissimos maiores deleniti voluptate ratione. At sit nihil perferendis veniam ad earum autem fugiat suscipit saepe, voluptatem tempore animi, voluptatibus aperiam aliquam aspernatur ducimus consectetur a natus vero doloremque deleniti hic ea assumenda? Reprehenderit minima, eos magni quibusdam expedita numquam libero dignissimos praesentium atque obcaecati inventore accusantium, ab labore tenetur quas possimus dolorem fugit deserunt a eligendi animi dolor voluptates impedit! Perferendis harum hic corrupti, magnam voluptatibus itaque natus cum dolor enim cumque rem error minima. Porro natus explicabo fugiat consectetur tempore corporis iste, dolores impedit architecto nobis non unde neque dolorem quisquam ratione minus amet dicta, ipsam optio quis ipsa eligendi nihil autem? Aliquam voluptates molestiae obcaecati assumenda.</p>
    </div>
</body>

</html>