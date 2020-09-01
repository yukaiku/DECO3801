using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class IsGameover : MonoBehaviour
{

    public enum TimeoutOptions
    {
        nothing = 0,
        jumpScene = 1,
    }

    public TimerUtility timer;
    public TimeoutOptions timeoutOptions;
    [Tooltip("used for jumping to other scene")]
    public string sceneName;
    private bool trigger = true;

    private void checkTimer()
    {
        if (timer == null)
        {
            IsGameover component = this.gameObject.GetComponent<IsGameover>();
            Destroy(component);

            Debug.Log(string.Format("Null timer assigned and the component won't work"));
        }
    }

    // do something when timeout
    private void doSomething()
    {
        if (trigger && (timer.timeStart <= 0))
        {
            // save player time spent here
            PlayerData.saveTime(timer.timeStart);

            switch (timeoutOptions)
            {
                case TimeoutOptions.nothing:
                    doNothing();
                    break;
                case TimeoutOptions.jumpScene:
                    doJumpScene();
                    break;
                default:
                    break;
            }

            trigger = false;
        }
    }

    // do nothing when timeout
    private void doNothing()
    {
        Debug.Log(string.Format("Timeout : Object '{0}' timer",
            this.gameObject.ToString()));
    }

    // jump to other scene when timeout
    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            SceneManager.LoadScene(sceneName);

            Debug.Log(string.Format("Timeout : load to '{0}' scene", sceneName));
        }
        else
        {
            Debug.Log(string.Format("Timeout : no such scene name"));
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        checkTimer();
    }

    // Update is called once per frame
    void Update()
    {
        doSomething();
    }
}
