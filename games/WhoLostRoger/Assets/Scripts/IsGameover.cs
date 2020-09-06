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
        showGameOver = 2
    }

    public TimerUtility timer;
    public TimeoutOptions timeoutOptions;

    public GameObject menuToShow;
    private GameObject newMenu;

    [ChoiceList(new[] { "LoadingScene" })]
    public string sceneName;
    private bool trigger = false;

    private void isTimerNull()
    {
        if (timer == null)
        {
            IsGameover component = this.gameObject.GetComponent<IsGameover>();
            Destroy(component);

            Debug.Log(string.Format("Null timer assigned and the component won't work"));
        }
    }

    private void isTimeout()
    {
        if (!trigger && timer.timeStart <= 0)
        {
            trigger = true;

            if (trigger)
            {
                // save player time spent
                DataSystem.saveTimeLeft(timer.timeStart);
                // do something when timeout
                doSomething();
            }
        }
    }

    private void doSomething()
    {
        switch (timeoutOptions)
        {
            case TimeoutOptions.nothing:
                doNothing();
                break;
            case TimeoutOptions.jumpScene:
                doJumpScene();
                break;
            case TimeoutOptions.showGameOver:
                doShowGameOver();
                break;
            default:
                break;
        }
    }

    private void doNothing()
    {
        Debug.Log(string.Format("Timeout : Object '{0}' timer",
            this.gameObject.ToString()));
    }

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

    private void doShowGameOver()
    {
      if (menuToShow != null)
      {
        // CODE-TO-ADD: Making the GameOverMenu spawn in center of screen. (Camera/Screen pos, maybe?)

        newMenu = Instantiate(menuToShow, new Vector3(0, 0, 0), Quaternion.identity) as GameObject;
        Debug.Log(string.Format("Created Menu: '{0}'", newMenu));
      } else {
        Debug.Log(string.Format("Failed to create Menu"));
      }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isTimerNull();
    }

    // Update is called once per frame
    void Update()
    {
        isTimeout();
    }
}
