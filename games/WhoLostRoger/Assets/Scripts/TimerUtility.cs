using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

// using the EventTrigger component for sprite objects
public class TimerUtility : MonoBehaviour
{
    public enum TimeoutOptions
    {
        nothing = 0,
        jumpScene = 1,
    }
    public float timeStart;        // time provided to start count down
    public TimeoutOptions timeoutOptions;
    public string sceneName;        // jump to other scene when timeout, if provided

    private float timeStartSave;        // back up the start time
    private bool timerActive = false;

    public void startTimer()
    {
        timeStartSave = timeStart;
        timerActive = true;
    }

    public void resetTimer()
    {
        timerActive = false;
        timeStart = timeStartSave;
    }

    public void clickTimer()
    {
        timerActive = !timerActive;
    }

    public void updateTimer()
    {
        if ((timerActive) && (timeStart >= 0))
        {
            timeStart -= Time.deltaTime;
            if (timeStart <= 0)
            {
                // do something when timeout
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
            }
        }
    }

    // do nothing when timeout
    private void doNothing()
    {
        Debug.Log(string.Format("Timeout : Object '{0}' timer", this.gameObject.ToString()));
    }

    // jump to other scene when timeout
    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            Debug.Log(string.Format("Timeout : load to '{0}' scene", sceneName));
            SceneManager.LoadScene(sceneName);
        }
        else
        {
            Debug.Log(string.Format("Timeout : no such scene name"));
        }
    }


    // Start is called before the first frame update
    void Start()
    {
        startTimer();
    }

    // Update is called once per frame
    void Update()
    {
        updateTimer();
    }
}
