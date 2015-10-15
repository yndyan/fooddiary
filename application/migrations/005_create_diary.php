<?php

class Migration_Create_diary extends CI_Migration
{
    public function up(){
        
        $this->dbforge->add_field(array(
                'diary_id' => array(
                                'type' => 'tinyint',
                				'constraint' => 11,
                				'unsigned' => TRUE,
                				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'diary_date' => array(
                                'type' => 'date',
                                'null' => false
                                ),
                'diary_time' => array(
                            'type' => 'time',
                            'null' => true
                            ),
                'user_id' => array(
                				'type' => 'tinyint',
                				'constraint' => 11,
                				'unsigned' => TRUE,
                                'null'  => false
                                ),
                'reason_id' => array(
            				'type' => 'tinyint',
            				'constraint' => 11,
            				'unsigned' => TRUE,
                            'null'  => true
			),
            ));
        $this->dbforge->add_key('diary_id',TRUE);
        $this->dbforge->create_table('diary');
        
        
                
            $this->dbforge->add_field(array(
                    'diary_course_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                    'course_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'diary_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                ),
                    'quantity' => array(
                                    'type' => 'varchar',
                                    'constraint' => 50,
                                ),
            ));
        $this->dbforge->add_key('diary_course_id',TRUE);
        $this->dbforge->create_table('diary_course');    
    }//up
    
    public function down(){
        $this->dbforge->drop_table('diary');
        $this->dbforge->drop_table('diary_course');
    }//down
    
}