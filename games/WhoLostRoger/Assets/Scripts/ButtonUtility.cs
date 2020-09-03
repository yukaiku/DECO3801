﻿using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class ButtonUtility : MonoBehaviour
{
    public void doLoadScene(string sceneName)
    {
        SceneManager.LoadScene(sceneName);
        Debug.Log(string.Format("Load '{0}' scene", sceneName));
    }

    public void doQuit()
    {
        Application.Quit();
        Debug.Log("Game quit.");
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {

    }

    // Update is called once per frame
    void Update()
    {

    }
}
