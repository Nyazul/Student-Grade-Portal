-- Student Info
CREATE TABLE student (
    usid VARCHAR(10) PRIMARY KEY NOT NULL,
    password VARCHAR(50) NOT NULL,
    rollno INTEGER NOT NULL,
    name VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    courseid VARCHAR(10) NOT NULL,
    UNIQUE(rollno, courseid)
);

INSERT INTO student (usid, password, rollno, name, mail, mobile, courseid) VALUES
    ('122010001', 'password1', 1, 'Nyaz Ansari', 'ansarinyazul2003@gmail.com', '8551055201', '129001'),
    ('122010002', 'password2', 1, 'Jane Smith', 'jane.smith@example.com', '9876543210', '129002'),
    ('122010003', 'password3', 2, 'Alice Johnson', 'alice.johnson@example.com', '5551234567', '129001'),
    ('122010004', 'password4', 2, 'Bob Williams', 'bob.williams@example.com', '9878765432', '129002'),
    ('122010005', 'password5', 3, 'Charlie Brown', 'charlie.brown@example.com', '5559876543', '129001'),
    ('122010006', 'password6', 3, 'David Clark', 'david.clark@example.com', '9871234567', '129002'),
    ('122010007', 'password7', 4, 'Eva Davis', 'eva.davis@example.com', '5558765432', '129001'),
    ('122010008', 'password8', 4, 'Frank Evans', 'frank.evans@example.com', '9875551234', '129002'),
    ('122010009', 'password9', 5, 'Grace White', 'grace.white@example.com', '5554445678', '129001'),
    ('122010010', 'password10', 5, 'Henry Lee', 'henry.lee@example.com', '9873339876', '129002'),
    ('122010011', 'password11', 6, 'Ivy Taylor', 'ivy.taylor@example.com', '5552223456', '129001'),
    ('122010012', 'password12', 6, 'Jack Miller', 'jack.miller@example.com', '9871116789', '129002'),
    ('122010013', 'password13', 7, 'Kate Harris', 'kate.harris@example.com', '5559998765', '129001'),
    ('122010014', 'password14', 7, 'Leo Robinson', 'leo.robinson@example.com', '9878882345', '129002'),
    ('122010015', 'password15', 8, 'Mia Turner', 'mia.turner@example.com', '5557778765', '129001'),
    ('122010016', 'password16', 8, 'Noah Scott', 'noah.scott@example.com', '9876662345', '129002'),
    ('122010017', 'password17', 9, 'Olivia Martinez', 'olivia.martinez@example.com', '5555558765', '129001'),
    ('122010018', 'password18', 9, 'Peter Wilson', 'peter.wilson@example.com', '9874442345', '129002'),
    ('122010019', 'password19', 10, 'Quinn Brown', 'quinn.brown@example.com', '5553338765', '129001'),
    ('122010020', 'password20', 10, 'Rachel Smith', 'rachel.smith@example.com', '9872222345', '129002'),
    ('122010021', 'password21', 11, 'Sam Wilson', 'sam.wilson@example.com', '5551112345', '129001'),
    ('122010022', 'password22', 11, 'Emily Davis', 'emily.davis@example.com', '9870009876', '129002'),
    ('122010023', 'password23', 12, 'Oscar Martinez', 'oscar.martinez@example.com', '5559992345', '129001'),
    ('122010024', 'password24', 12, 'Zoe Turner', 'zoe.turner@example.com', '9878888765', '129002'),
    ('122010025', 'password25', 13, 'Aiden Robinson', 'aiden.robinson@example.com', '5557772345', '129001'),
    ('122010026', 'password26', 13, 'Lily Smith', 'lily.smith@example.com', '9876668765', '129002'),
    ('122010027', 'password27', 14, 'Caleb Johnson', 'caleb.johnson@example.com', '5555552345', '129001'),
    ('122010028', 'password28', 14, 'Grace Wilson', 'grace.wilson@example.com', '9874448765', '129002'),
    ('122010029', 'password29', 15, 'Ella White', 'ella.white@example.com', '5553332345', '129001'),
    ('122010030', 'password30', 15, 'Benjamin Lee', 'benjamin.lee@example.com', '9872228765', '129002'),
    ('122010031', 'password31', 16, 'Liam Taylor', 'liam.taylor@example.com', '5551113456', '129001'),
    ('122010032', 'password32', 16, 'Ava Brown', 'ava.brown@example.com', '9870009876', '129002'),
    ('122010033', 'password33', 17, 'Sophia Harris', 'sophia.harris@example.com', '5559995678', '129001'),
    ('122010034', 'password34', 17, 'Jackson Miller', 'jackson.miller@example.com', '9878881234', '129002'),
    ('122010035', 'password35', 18, 'Oliver Scott', 'oliver.scott@example.com', '5557775678', '129001'),
    ('122010036', 'password36', 18, 'Chloe Davis', 'chloe.davis@example.com', '9876661234', '129002'),
    ('122010037', 'password37', 19, 'Emma Wilson', 'emma.wilson@example.com', '5555555678', '129001'),
    ('122010038', 'password38', 19, 'Lucas Turner', 'lucas.turner@example.com', '9874441234', '129002'),
    ('122010039', 'password39', 20, 'Mia Robinson', 'mia.robinson@example.com', '5553335678', '129001'),
    ('122010040', 'password40', 20, 'Alexander Smith', 'alexander.smith@example.com', '9872221234', '129002'),
    ('122010041', 'password41', 21, 'Sophie Davis', 'sophie.davis@example.com', '5551112345', '129001'),
    ('122010042', 'password42', 21, 'Ethan Turner', 'ethan.turner@example.com', '9870009876', '129002'),
    ('122010043', 'password43', 22, 'Emma Robinson', 'emma.robinson@example.com', '5559992345', '129001'),
    ('122010044', 'password44', 22, 'Aiden Smith', 'aiden.smith@example.com', '9878888765', '129002'),
    ('122010045', 'password45', 23, 'Olivia Johnson', 'olivia.johnson@example.com', '5557772345', '129001'),
    ('122010046', 'password46', 23, 'Lucas Wilson', 'lucas.wilson@example.com', '9876668765', '129002'),
    ('122010047', 'password47', 24, 'Liam Harris', 'liam.harris@example.com', '5555552345', '129001'),
    ('122010048', 'password48', 24, 'Chloe Miller', 'chloe.miller@example.com', '9874448765', '129002'),
    ('122010049', 'password49', 25, 'Ella Brown', 'ella.brown@example.com', '5553332345', '129001'),
    ('122010050', 'password50', 25, 'Mason Lee', 'mason.lee@example.com', '9872228765', '129002'),
    ('122010051', 'password51', 26, 'Ava Taylor', 'ava.taylor@example.com', '5551113456', '129001'),
    ('122010052', 'password52', 26, 'Oliver Brown', 'oliver.brown@example.com', '9870009876', '129002'),
    ('122010053', 'password53', 27, 'Isabella Harris', 'isabella.harris@example.com', '5559995678', '129001'),
    ('122010054', 'password54', 27, 'Jackson Turner', 'jackson.turner@example.com', '9878881234', '129002'),
    ('122010055', 'password55', 28, 'Mia Scott', 'mia.scott@example.com', '5557775678', '129001'),
    ('122010056', 'password56', 28, 'Benjamin Davis', 'benjamin.davis@example.com', '9876661234', '129002'),
    ('122010057', 'password57', 29, 'Amelia Wilson', 'amelia.wilson@example.com', '5555555678', '129001'),
    ('122010058', 'password58', 29, 'Henry Turner', 'henry.turner@example.com', '9874441234', '129002'),
    ('122010059', 'password59', 30, 'Evelyn Robinson', 'evelyn.robinson@example.com', '5553335678', '129001'),
    ('122010060', 'password60', 30, 'Carter Smith', 'carter.smith@example.com', '9872221234', '129002'),
    ('122010061', 'password61', 31, 'Avery Davis', 'avery.davis@example.com', '5551112345', '129001'),
    ('122010062', 'password62', 31, 'Wyatt Turner', 'wyatt.turner@example.com', '9870009876', '129002'),
    ('122010063', 'password63', 32, 'Addison Robinson', 'addison.robinson@example.com', '5559992345', '129001'),
    ('122010064', 'password64', 32, 'Sebastian Smith', 'sebastian.smith@example.com', '9878888765', '129002'),
    ('122010065', 'password65', 33, 'Scarlett Johnson', 'scarlett.johnson@example.com', '5557772345', '129001'),
    ('122010066', 'password66', 33, 'Elijah Wilson', 'elijah.wilson@example.com', '9876668765', '129002'),
    ('122010067', 'password67', 34, 'Grace Harris', 'grace.harris@example.com', '5555552345', '129001'),
    ('122010068', 'password68', 34, 'Grayson Miller', 'grayson.miller@example.com', '9874448765', '129002'),
    ('122010069', 'password69', 35, 'Zoe Brown', 'zoe.brown@example.com', '5553332345', '129001'),
    ('122010070', 'password70', 35, 'Gabriel Lee', 'gabriel.lee@example.com', '9872228765', '129002'),
    ('122010071', 'password71', 36, 'Lily Taylor', 'lily.taylor@example.com', '5551113456', '129001'),
    ('122010072', 'password72', 36, 'Isaac Brown', 'isaac.brown@example.com', '9870009876', '129002'),
    ('122010073', 'password73', 37, 'Nora Harris', 'nora.harris@example.com', '5559995678', '129001'),
    ('122010074', 'password74', 37, 'Olivia Turner', 'olivia.turner@example.com', '9878881234', '129002'),
    ('122010075', 'password75', 38, 'Lucas Scott', 'lucas.scott@example.com', '5557775678', '129001'),
    ('122010076', 'password76', 38, 'Evelyn Davis', 'evelyn.davis@example.com', '9876661234', '129002'),
    ('122010077', 'password77', 39, 'Hazel Wilson', 'hazel.wilson@example.com', '5555555678', '129001'),
    ('122010078', 'password78', 39, 'Mason Turner', 'mason.turner@example.com', '9874441234', '129002'),
    ('122010079', 'password79', 40, 'Aria Robinson', 'aria.robinson@example.com', '5553335678', '129001'),
    ('122010080', 'password80', 40, 'Caleb Smith', 'caleb.smith@example.com', '9872221234', '129002');


--Teacher Info
CREATE TABLE teacher (
    utid VARCHAR(10) PRIMARY KEY NOT NULL,
    password VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    courseid VARCHAR(10) NOT NULL,
    subject VARCHAR(20) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    mobile VARCHAR(20) NOT NULL
);

INSERT INTO teacher (utid, password, name, courseid, subject, mail, mobile) VALUES
    ('62001', 'teacher1pass', 'teachername1', '129002', 'BRM', 'teacher1@example.com', '1234567890'),
    ('62002', 'teacher2pass', 'teachername2', '129002', 'MA', 'teacher2@example.com', '9876543210'),
    ('62003', 'teacher3pass', 'teachername3', '129002', 'LAB', 'teacher3@example.com', '5551234567'),
    ('62004', 'teacher4pass', 'teachername4', '129002', 'ED', 'teacher4@example.com', '9878765432'),
    ('62005', 'teacher5pass', 'teachername5', '129002', 'DB', 'teacher5@example.com', '5559876543'),
    ('62006', 'teacher6pass', 'teachername6', '129002', 'EABD', 'teacher6@example.com', '9871234567'),
    ('62007', 'teacher7pass', 'teachername7', '129002', 'OB', 'teacher7@example.com', '5558765432'),
    ('62008', 'teacher8pass', 'teachername8', '129002', 'BCOM', 'teacher8@example.com', '9875551234'),
    ('62009', 'teacher9pass', 'teachername9', '129002', 'MF', 'teacher9@example.com', '5554445678'),
    ('62010', 'teacher10pass', 'teachername10', '129001', 'OS', 'teacher10@example.com', '9873339876'),
    ('62011', 'teacher11pass', 'teachername11', '129001', 'ST', 'teacher11@example.com', '5552223456'),
    ('62012', 'teacher12pass', 'teachername12', '129001', 'PracCourse_I', 'teacher12@example.com', '9871116789'),
    ('62013', 'teacher13pass', 'teachername13', '129001', 'WT_II', 'teacher13@example.com', '5559998765'),
    ('62014', 'teacher14pass', 'teachername14', '129001', 'DA', 'teacher14@example.com', '9878882345'),
    ('62015', 'teacher15pass', 'teachername15', '129001', 'PracCourse_II', 'teacher15@example.com', '5557778765'),
    ('62016', 'teacher16pass', 'teachername16', '129001', 'OOPSJava', 'teacher16@example.com', '9876662345'),
    ('62017', 'teacher17pass', 'teachername17', '129001', 'CC', 'teacher17@example.com', '5555558765'),
    ('62018', 'teacher18pass', 'teachername18', '129001', 'PracCourse_III', 'teacher18@example.com', '9874442345'),
    ('62019', 'teacher19pass', 'teachername19', '129001', 'STT', 'teacher19@example.com', '5553338765'),
    ('62020', 'teacher20pass', 'teachername20', '129001', 'Project', 'teacher20@example.com', '9872222345');


--Admin Info
CREATE TABLE admin (
    uaid VARCHAR(10) PRIMARY KEY NOT NULL,
    password VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    mobile VARCHAR(20) NOT NULL
);

INSERT INTO admin (uaid, password, name, mail, mobile) VALUES
    ('10701', 'godrole1', 'adminname1', 'adminisgod1@example.com', '5558887444'),
    ('10702', 'godrole2', 'adminname2', 'iamgod2@example.com', '9999555555');


--Course Results
CREATE TABLE course129001 (
    usid VARCHAR(10) PRIMARY KEY REFERENCES student NOT NULL,
    OS INTEGER,
    ST INTEGER,
    PracCourse_I INTEGER,
    WT_II INTEGER,
    DA INTEGER,
    PracCourse_II INTEGER,
    OOPSJava INTEGER,
    CC INTEGER,
    PracCourse_III INTEGER,
    STT INTEGER,
    Project INTEGER
);

INSERT INTO course129001 (usid, OS, ST, PracCourse_I, WT_II, DA, PracCourse_II, OOPSJava, CC, PracCourse_III, STT, Project)
VALUES
    ('122010001', 65, 33, 68, 62, 74, 66, 59, 83, 61, 70, 68),
    ('122010003', 45, 66, 47, 53, 69, 65, 67, 68, 70, 42, 66),
    ('122010005', 68, 64, 69, 55, 63, 68, 66, 41, 67, 70, 63),
    ('122010007', 53, 68, 65, 62, 74, 67, 61, 69, 66, 63, 70),
    ('122010009', 67, 65, 34, 69, 68, 62, 70, 63, 66, 41, 69),
    ('122010011', 61, 69, 62, 68, 67, 70, 63, 35, 69, 64, 62),
    ('122010013', 66, 62, 70, 31, 66, 69, 67, 34, 63, 65, 68),
    ('122010015', 70, 63, 68, 66, 65, 34, 61, 69, 67, 62, 66),
    ('122010017', 34, 67, 66, 70, 31, 68, 63, 65, 68, 67, 31),
    ('122010019', 67, 70, 63, 61, 68, 67, 62, 69, 34, 66, 65),
    ('122010021', 62, 66, 61, 67, 69, 63, 65, 68, 70, 34, 61),
    ('122010023', 65, 64, 67, 68, 61, 70, 69, 63, 66, 62, 70),
    ('122010025', 66, 69, 64, 61, 65, 67, 68, 62, 70, 66, 34),
    ('122010027', 69, 67, 62, 66, 70, 31, 64, 65, 68, 63, 66),
    ('122010029', 33, 65, 66, 64, 67, 70, 68, 69, 62, 61, 67),
    ('122010031', 64, 68, 69, 62, 31, 66, 63, 70, 67, 65, 69),
    ('122010033', 66, 31, 65, 67, 63, 64, 69, 62, 68, 66, 70),
    ('122010035', 68, 63, 62, 70, 69, 66, 64, 65, 68, 67, 61),
    ('122010037', 64, 67, 66, 64, 61, 68, 63, 65, 68, 61, 69),
    ('122010039', 67, 70, 63, 61, 68, 67, 62, 69, 64, 66, 65),
    ('122010041', 55, 63, 48, 42, 56, 49, 55, 46, 53, 40, 52),
    ('122010043', 68, 49, 53, 45, 52, 59, 44, 61, 50, 59, 58),
    ('122010045', 60, 57, 42, 51, 48, 54, 57, 41, 56, 45, 60),
    ('122010047', 52, 50, 55, 58, 47, 53, 46, 57, 49, 51, 59),
    ('122010049', 49, 58, 44, 54, 41, 48, 53, 46, 50, 43, 52),
    ('122010051', 61, 53, 48, 43, 45, 56, 59, 54, 50, 44, 47),
    ('122010053', 57, 45, 52, 46, 53, 60, 50, 59, 47, 58, 56),
    ('122010055', 50, 59, 41, 57, 49, 51, 55, 52, 58, 44, 60),
    ('122010057', 48, 52, 58, 55, 47, 46, 58, 49, 60, 51, 49),
    ('122010059', 56, 60, 49, 43, 53, 52, 47, 50, 59, 57, 46),
    ('122010061', 59, 50, 54, 58, 42, 53, 60, 48, 55, 51, 43),
    ('122010063', 54, 48, 59, 56, 45, 51, 46, 57, 52, 44, 57),
    ('122010065', 58, 55, 46, 60, 57, 52, 54, 44, 46, 55, 48),
    ('122010067', 47, 46, 56, 54, 59, 45, 48, 43, 52, 60, 56),
    ('122010069', 43, 51, 57, 50, 59, 56, 54, 45, 47, 53, 58),
    ('122010071', 45, 58, 44, 57, 46, 59, 60, 50, 48, 55, 46),
    ('122010073', 51, 49, 58, 45, 60, 43, 57, 46, 55, 50, 54),
    ('122010075', 59, 45, 52, 59, 50, 47, 46, 48, 54, 51, 45),
    ('122010077', 53, 57, 51, 46, 54, 50, 59, 56, 43, 45, 57),
    ('122010079', 46, 53, 55, 48, 51, 58, 43, 60, 47, 52, 50);


--Course Results
CREATE TABLE course129002 (
    usid VARCHAR(10) PRIMARY KEY REFERENCES student NOT NULL,
    BRM INTEGER,
    LAB INTEGER,
    MA INTEGER,
    ED INTEGER,
    DB INTEGER,
    EABD INTEGER,
    OB INTEGER,
    BOM INTEGER,
    MF INTEGER
);

INSERT INTO course129002 (usid, BRM, LAB, MA, ED, DB, EABD, OB, BOM, MF)
VALUES
    ('122010002', 45, 60, 70, 55, 80, 67, 42, 75, 60),
    ('122010004', 58, 45, 52, 63, 51, 60, 55, 50, 57),
    ('122010006', 60, 57, 42, 51, 68, 54, 57, 41, 56),
    ('122010008', 52, 50, 55, 58, 47, 53, 46, 57, 49),
    ('122010010', 49, 58, 44, 54, 41, 48, 53, 46, 50),
    ('122010012', 61, 53, 48, 43, 56, 59, 54, 50, 59),
    ('122010014', 57, 45, 52, 46, 53, 60, 50, 59, 47),
    ('122010016', 50, 59, 41, 57, 46, 51, 55, 52, 58),
    ('122010018', 48, 52, 58, 55, 47, 46, 58, 49, 60),
    ('122010020', 56, 60, 49, 43, 52, 59, 58, 44, 46),
    ('122010022', 59, 50, 54, 58, 42, 53, 60, 48, 55),
    ('122010024', 54, 48, 59, 56, 45, 51, 46, 57, 52),
    ('122010026', 58, 55, 46, 60, 57, 52, 54, 44, 46),
    ('122010028', 47, 46, 56, 54, 59, 45, 48, 43, 52),
    ('122010030', 43, 51, 57, 50, 59, 56, 54, 45, 47),
    ('122010032', 45, 58, 44, 57, 46, 59, 60, 50, 48),
    ('122010034', 51, 49, 58, 45, 60, 43, 57, 46, 55),
    ('122010036', 59, 45, 52, 59, 50, 47, 46, 48, 54),
    ('122010038', 53, 57, 51, 46, 54, 50, 59, 56, 43),
    ('122010040', 46, 53, 55, 48, 51, 58, 43, 60, 47),
    ('122010042', 55, 63, 48, 42, 56, 49, 55, 46, 53),
    ('122010044', 68, 49, 53, 45, 52, 59, 44, 61, 50),
    ('122010046', 60, 57, 42, 51, 48, 54, 57, 41, 56),
    ('122010048', 52, 50, 55, 58, 47, 53, 46, 57, 49),
    ('122010050', 49, 58, 44, 54, 41, 48, 53, 46, 50),
    ('122010052', 61, 53, 48, 43, 45, 56, 59, 54, 50),
    ('122010054', 57, 45, 52, 46, 53, 60, 50, 59, 47),
    ('122010056', 50, 59, 41, 57, 49, 51, 55, 52, 58),
    ('122010058', 48, 52, 58, 55, 47, 46, 58, 49, 60),
    ('122010060', 56, 60, 49, 43, 52, 59, 58, 44, 46),
    ('122010062', 59, 50, 54, 58, 42, 53, 60, 48, 55),
    ('122010064', 54, 48, 59, 56, 45, 51, 46, 57, 52),
    ('122010066', 58, 55, 46, 60, 57, 52, 54, 44, 46),
    ('122010068', 47, 46, 56, 54, 59, 45, 48, 43, 52),
    ('122010070', 43, 51, 57, 50, 59, 56, 54, 45, 47),
    ('122010072', 45, 58, 44, 57, 46, 59, 60, 50, 48),
    ('122010074', 51, 49, 58, 45, 60, 43, 57, 46, 55),
    ('122010076', 59, 45, 52, 59, 50, 47, 46, 48, 54),
    ('122010078', 53, 57, 51, 46, 54, 50, 59, 56, 43),
    ('122010080', 46, 53, 55, 48, 51, 58, 43, 60, 47);


--Course Metadata
CREATE TABLE course_metadata (
    course VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL
);

INSERT INTO course_metadata (course, name) VALUES
    ('course129001', 'B.Sc.(COMPUTER SCIENCE) (Rev.2019) - OCTOBER 2023'),
    ('course129002', 'Masters in Bussiness Administration (Rev.2019) - OCTOBER 2023');


CREATE TABLE notices (
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ,
    head VARCHAR(100),
    body VARCHAR(10000)
);

INSERT INTO notices (head, body) VALUES
    ('March Exams', 'The examinations are scheduled in march. Time Table will be provided soon on your official whatsapp groups.'),
    ('Gathering Ceremony', 'Gathering Ceremony will start from 13 july'),
    ('Notice1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime praesentium recusandae laudantium autem odio debitis magni, libero mollitia aperiam explicabo sapiente qui sequi distinctio necessitatibus harum sed repudiandae, eligendi voluptate et illum ex! Dolores quas facere illum possimus soluta? Eligendi reprehenderit illo libero cum officia deleniti doloremque excepturi? Ipsa odit aut quam sapiente reprehenderit itaque repudiandae, fuga velit, quisquam dolorum assumenda rerum cupiditate nam et necessitatibus. Magni dignissimos quidem, omnis commodi a laborum temporibus vitae cupiditate cum esse, perspiciatis distinctio explicabo. Magni voluptates odio debitis voluptatum optio alias fuga, sit molestias, placeat, consequatur sequi delectus? Aliquid necessitatibus tempore fuga cum, incidunt molestias ad ullam doloribus quisquam saepe voluptatem magni quia provident nostrum modi amet similique quas natus laudantium, delectus suscipit accusamus possimus. Nulla qui, saepe neque, animi architecto aliquid quas consequuntur quibusdam vitae quaerat sint ullam velit dicta accusamus blanditiis sequi temporibus in nobis ipsam alias culpa non incidunt. Pariatur hic maiores nisi molestias corrupti voluptates culpa, nam dolor commodi quis accusantium deleniti sed fugit sapiente, impedit natus aperiam praesentium nemo quod rem corporis quidem repellat, illo ipsam.'),
    ('Notice2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime praesentium recusandae laudantium autem odio debitis magni, libero mollitia aperiam explicabo sapiente qui sequi distinctio necessitatibus harum sed repudiandae, eligendi voluptate et illum ex! Dolores quas facere illum possimus soluta?');

CREATE TABLE feedback (
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    head VARCHAR(100),
    body VARCHAR(10000),
    userid VARCHAR(10),
    usertype Varchar(10)
);

INSERT INTO feedback (head, body, userid, usertype) VALUES
    ('Result Format Improvement', 'Change the size of the result to fit the whole page while downloading.', '122010001', 'student'),
    ('Email Notifications', 'Send emails to students to notify whenever result is published', '122010001', 'student');