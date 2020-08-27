using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

// using the EventTrigger component for sprite objects
public class ButtonUtility : MonoBehaviour
{
    public void doLoadScene(string sceneName)
    {
        Debug.Log(string.Format("Load '{0}' scene", sceneName));
        SceneManager.LoadScene(sceneName);
    }

    public void doExit()
    {
        Debug.Log("Game quit.");
        Application.Quit();
    }


    // Start is called before the first frame update
    void Start()
    {

    }

    // Update is called once per frame
    void Update()
    {

    }
}
