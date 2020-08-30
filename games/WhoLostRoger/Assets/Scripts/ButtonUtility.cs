using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class ButtonUtility : MonoBehaviour
{
    public void doLoadScene(string sceneName)
    {
        Debug.Log(string.Format("Load '{0}' scene", sceneName));
        SceneManager.LoadScene(sceneName);
    }

    public void doQuit()
    {
        Debug.Log("Game quit.");
        Application.Quit();
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
