<?php

class Migration_Create_groceries extends CI_Migration
{
        private $default_quantity = array(    
        ['name' => "g"],
        ['name' => "mg"],
        ['name' => "dg"],
        ['name' => "kg"],
        ['name' => "mL"],
        ['name' => "dL"],
        ['name' => "L"],
        ['name' => "piese"],
        ['name' => "teaspoon"],
        ['name' => "spoon"]
        
    );
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
                'calories' => array(
                                'type' => 'int',
				'constraint' => 20,
				'unsigned' => TRUE
                                ),
                'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
			),
        ));
        $this->dbforge->add_key('groceries_id',TRUE);
        $this->dbforge->create_table('groseries');
        
        $this->dbforge->add_field(array(
                'quantity_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'name' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
        ));
        $this->dbforge->add_key('quantity_id',TRUE);
        $this->dbforge->create_table('default_quantity');
        
        $this->db->insert_batch('default_quantity',  $this->default_quantity); 

    }//up
    
    public function down(){
                $this->dbforge->drop_table('groseries');
                $this->dbforge->drop_table('default_quantity');
    }//down
    
    
}
