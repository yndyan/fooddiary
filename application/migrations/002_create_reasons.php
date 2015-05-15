<?php

class Migration_Create_reasons extends CI_Migration
{
    private $default_reasons = array(    
        ['reasonname' => "Hungry"],
        ['reasonname' => "Bored"],
        ['reasonname' => "Free food"],
        ['reasonname' => "Cheap food"],
        ['reasonname' => "Tired"],
        ['reasonname' => "Stressed"],
        ['reasonname' => "Movie"],
        ['reasonname' => "Reward"],
        ['reasonname' => "Anxious"],
        ['reasonname' => "Insomnia"],
        ['reasonname' => "Others eat"],
        ['reasonname' => "Will be hungry"],
        ['reasonname' => "Feeling empty"],
        ['reasonname' => "Special occasion"],
        ['reasonname' => "Take a break"],
        ['reasonname' => "Worried"],
        ['reasonname' => "Procrastinate"],
    );

    	public function up()
	{
		$this->dbforge->add_field(array(
			'reason_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
			),
                        
                        'reasonname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => true,
                        ),
                        
		));
                
                $this->dbforge->add_key('reason_id',TRUE);
		$this->dbforge->create_table('default_reasons');
                $this->db->query("ALTER TABLE default_reasons ADD UNIQUE INDEX (`reasonname`)");
                $this->db->insert_batch('default_reasons',  $this->default_reasons);
                
                $this->dbforge->add_field(array(
			'reason_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
			),
                        
                        'reasonname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => true,
                                
                        ),
                        'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null' => true
			),
                        
		));
                
                $this->dbforge->add_key('reason_id',TRUE);
		$this->dbforge->create_table('user_reasons');
	}

	public function down()
	{
		$this->dbforge->drop_table('default_reasons');
                $this->dbforge->drop_table('user_reasons');
	}
    
    
}
