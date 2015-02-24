<?php

class Migration_Create_users extends CI_Migration {


//        `userStatus` tinyint(2) DEFAULT NULL,
//        `fullName` varchar(30) DEFAULT NULL,
//        `verifyCode` varchar(34) DEFAULT NULL,
//        `verifyExpTime` int(11) DEFAULT NULL,
//        `passResetCode` varchar(34) DEFAULT NULL,
//        `passResetExpTime` int(11) DEFAULT NULL,
//        PRIMARY KEY (`id`),
//        UNIQUE KEY `username` (`username`),
//        UNIQUE KEY `verifyCode` (`verifyCode`),
//        UNIQUE KEY `passResetCode` (`passResetCode`)
//      ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
    
	public function up()
	{
		$this->dbforge->add_field(array(
			'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
			),
                        
                        'username' => array(
                                'type' => 'varchar',
                                'constraint'=> 200,
                                'null' => false,
                                
                        ),
                        'password' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false,
                        ),
			'email' => array(
				'type'          =>      'VARCHAR',
				'constraint'    =>      '200',
                                'null'          =>      false
			),
			'userstatus' => array(
				'type' => 'tinyint',
				'constraint' => 2,
                                'null'  => true
                                
			),
			'fullname' => array(
				'type' => 'varchar',
				'constraint' => 30,
                                'null'  => true
			),
                        'verifycode' => array(
				'type' => 'varchar',
				'constraint' => 34,
                                'null'  => true
			),
                        'verifyexptime' => array(
                                    'type' => 'int',
                                    'constraint' => 11,
                                    'null'  => true
                        ),
                        'passresetcode' => array(
                                        'type' => 'varchar',
                                        'constraint' => 34,
                                        'null'  => true
                        ),
                        'passresetexptime' => array(
                                        'type' => 'int',
                                        'constraint' => 11,
                                        'null'  => true
                        )
		));
                
                $this->dbforge->add_key('user_id',TRUE);
		$this->dbforge->create_table('users');
                $this->db->query("ALTER TABLE users ADD UNIQUE INDEX (`username`)");
                $this->db->query("ALTER TABLE users ADD UNIQUE INDEX (`email`)");
                $this->db->query("ALTER TABLE users ADD UNIQUE INDEX (`passresetcode`)");
                
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}