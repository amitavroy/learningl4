<?php 

class Node extends Eloquent
{

  protected $tableName = 'node';

  /**
   * This function will return the node ids of the latest
   * content on the website which are published.
   * @param  integer $count  number of articles
   * @param  integer $offset starting point
   * @return array of node ids.
   */
  public function getLatestNodes($count = 10, $offset = 0, $type = null)
  {
    $query = DB::table($this->tableName);

    $query->select('nid');
    $query->where('status', '=', 1);
    $query->take($count)->skip($offset);
    $query->orderBy('created', 'desc');

    if ($type != null)
      $query->where('type', '=', $type);

    $nids = $query->get();

    // converting into an array
    $nidArray = array();
    foreach ($nids as $nid)
    {
      $nidArray[] = $nid->nid;
    }

    return $nidArray;
  }

  /**
   * This is the public function which will be used
   * to load multiple / single node.
   * @param  array / int $nids single id or array of ids
   * @return nodes
   */
  public function getNodeMultiple($nids)
  {
    $nodes = array();

    if (is_array($nids))
    {
      foreach ($nids as $nid)
      {
        $nodes[] = $this->getNode($nid);
      }
    }
    else
    {
      $nodes = $this->getNode($nids);
    }

    return $nodes;
  }

  /**
   * This is the function which will run the query and generate the basic node object.
   * @param  int $nid node id
   * @return returns the node query object.
   */
  protected function getNode($nid)
  {
    $selectArray = array(
      'node.nid as nodeId',
      'node.type as nodeType',
      'node.title as nodeTitle',
      'node.created as nodeCreated',
      'node.changed as nodeUpdated',
      'node.changed as nodeUpdated',
      'field_data_body.body_value as nodeBody',
      'field_data_body.body_summary as nodeSummary',
    );

    $query = DB::table('node');

    // select fields
    $query->select($selectArray);

    // get by id
    $query->where('node.nid', '=', $nid);

    // join body table
    $query->join('field_data_body', 'field_data_body.entity_id', '=', 'node.nid');
    $query->where('field_data_body.entity_type', '=', 'node'); // take only node entity

    return $query;
  }

  /**
   * This function will return all the terms associated with a node.
   * @param  int / array $nids single / array of node ids
   * @return returns the term / terms in a node by node id.
   */
  public function getNodeTerms($nids)
  {
    $terms = array();
    if (is_array($nids))
    {
      foreach ($nids as $nid)
      {
        $terms = $this->getSingleTerm($nid);
      }
    }
    else
    {
      $terms = $this->getSingleTerm($nids);
    }

    return $terms;
  }

  /**
   * This function is generating the result of the terms in a node
   * based on the node id provided.
   * @param  int $nid node id
   * @return returns the terms associated with the node.
   */
  protected function getSingleTerm($nid)
  {
    $selectArray = array(
      'taxonomy_index.tid as termId',
      'taxonomy_term_data.name as termName',
      'taxonomy_term_data.vid as termVocabId',
      'taxonomy_term_data.description as termDesc',
    );

    $query = DB::table('taxonomy_index');

    $query->select($selectArray);
    
    $query->where('taxonomy_index.nid', '=', $nid);

    $query->join('taxonomy_term_data', 'taxonomy_term_data.tid', '=', 'taxonomy_index.tid');

    return $query->get();
  }
}