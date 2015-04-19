<?php

/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class LocationController
{

    /**
     * @Autowired - LocationManager
     *
     * @var LocationManager
     */
    public $locationManager;

    /**
     * Controller method to get all available locations.
     *
     * @return array
     */
    public function listLocations()
    {
        return $this->locationManager->findLocations();
    }

    /**
     * Controller method to create a new location.
     *
     * @return Location
     */
    public function createLocation()
    {
        $location = HTTPRequestHelper::getParamAsModel(new Location());
        return $this->locationManager->createLocation($location);
    }
    
    /**
     * Controller method to update an existsing location.
     *
     * @return Location
     */
    public function updateLocation($locationId)
    {
        $oldLocation = $this->locationManager->findLocation($locationId);
        $location = HTTPRequestHelper::getParamAsModel(new Location());
        $location->gallery = $oldLocation->gallery;
        $location->id = $locationId;
        
        return $this->locationManager->updateLocation($location);
    }

    /**
     * Controller method to get a speicfied location.
     *
     * @return Location
     */
    public function getLocation($id)
    {
        return $this->locationManager->findLocation($id);
    }

    /**
     * Controller method to remove a speicfied location.
     *
     * @return bool
     */
    public function deleteLocation($id)
    {
        return $this->locationManager->deleteLocation($id);
    }
    
    /**
     * Controller method to add an attachment.
     *
     * @param string $locationId
     *            Id of the Location.
     * @return boolean
     */
    public function addImage($locationId)
    {
        HTTPResponseHelper::setContentType("text/html; charset=utf-8");
    
        $files = HTTPRequestHelper::getUploadedFiles();
        return $this->locationManager->addImage($locationId, $files[0]);
    }
}