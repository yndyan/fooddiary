<?php

class Migration_Create_groceries extends CI_Migration
{
    
    public function up(){
        $this->dbforge->add_field(array(
                
                'groceries_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'foodname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
                
                'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                )
        ));
        $this->dbforge->add_key('groceries_id',TRUE);
        $this->dbforge->create_table('groseries');
        


    }//up
    
    public function down(){
                $this->dbforge->drop_table('groseries');
        
    }//down
    
    
}
