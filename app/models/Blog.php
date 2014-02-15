<?php 

class Blog extends Node
{
  protected $cacheTime = 1;
  /**
   * This function provides the latest published blogs
   * @param  integer $count
   * @param  integer $offset
   * @return returns an array of blog node ids
   */
  public function getLatestBlogs($count = 10, $offset = 0)
  {
    $cachedData = Helper::getCacheIfPresent('blog-latest-' . $count . '-' . $offset);
    if ($cachedData)
    {
      return $cachedData;
    }

    $ids = parent::getLatestNodes($count, $offset, 'article'); // getting data from node

    Cache::put('blog-latest-' . $count . '-' . $offset, $ids, $this->cacheTime);

    return $ids;
  }

  /**
   * This function is generating the blog node object 
   * calling the parent node class. 
   * @param  int / array $blogIds single / array of node ids
   * @return the blog array
   */
  public function getBlogs($blogIds)
  {
    $blogs = array();

    if (is_array($blogIds))
    {
      // looping through each id and getting the blog data
      foreach ($blogIds as $id) 
      {
        $blogs[] = $this->getBlog($id);
      }
    }
    else // else this is a request for single blog
    {
      $blogs = $this->getBlog($blogIds);
    }

    return $blogs;
  }

  /**
   * This function will always return a single node object.
   * Caching mechanism is applied on this function.
   * @param  int $blogId the blog id
   * @return array       the array of the blog.
   */
  protected function getBlog($blogId)
  {

    $cachedData = Helper::getCacheIfPresent('blog-' . $blogId);
    if ($cachedData)
    {
      return $cachedData;
    }

    $blog = parent::getNodeMultiple($blogId); // getting data from node
    $blog = $blog->first();

    $blogData = array(
      'content' => $blog,
      'tags' => parent::getNodeTerms($blog->nodeId),
      'url_alias' => parent::getNodeAlias($blog->nodeId),
    );

    Cache::put('blog-' . $blogId, $blogData, $this->cacheTime);

    return $blogData;
  }
}