using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.EventSystems;

/*
 * This component script is used for providing time penality while a player 
 * clicks a noun object wrongly in one level.
 * 
 * In Unity inspecter,
 * @require TimerUtility        timer
 * 
 */
public class TimePenality : MonoBehaviour
{
    public TimerUtility timer;

    private void isTimerNull()
    {
        if (timer == null)
        {
            TimePenality component = this.gameObject.GetComponent<TimePenality>();
            Destroy(component);

            Debug.Log(string.Format("Null timer assigned and the component won't work"));
        }
    }

    public void setTimePenality()
    {

    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        // check if the mouse was clicked over a UI element
        if (EventSystem.current.IsPointerOverGameObject())
            return;

        Vector3 mousePos = Camera.main.ScreenToWorldPoint(Input.mousePosition);
        Vector2 mousePos2D = new Vector2(mousePos.x, mousePos.y);
        RaycastHit2D hit = Physics2D.Raycast(mousePos2D, Vector2.zero);
        if (hit.collider != null)
        {
            Debug.Log(hit.collider.gameObject.name);
            timer.timeDown(1);
        }
    }

    // Start is called before the first frame update
    void Start()
    {
        isTimerNull();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
